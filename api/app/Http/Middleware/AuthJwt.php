<?php

namespace App\Http\Middleware;

use App\Shared\Exceptions\AuthException;
use Closure;
use Domains\User\Contracts\SessionRepositoryInterface;
use Domains\User\Models\JwtToken;
use Domains\User\Models\User;
use Illuminate\Http\Request;
use Infrastructure\Services\Jwt\Contracts\JwtManagerInterface;
use Symfony\Component\HttpFoundation\Response;

final readonly class AuthJwt
{
    public function __construct(
        private JwtManagerInterface $jwtManager,
        private SessionRepositoryInterface $sessionRepository,
    ) {
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        /** @var JwtToken|null $session */
        $session = $this->sessionRepository->findBy('unique_id', $token);

        if (!$session) {
            return response()->json(['message' => 'Unauthorized'], Response::HTTP_UNAUTHORIZED);
        }

        try {
            $tokenData = $this->jwtManager->parse($token);

            if ($tokenData->getExp() < time()) {
                $this->sessionRepository->delete($session);

                return response()->json(['message' => 'Token Expired'], Response::HTTP_UNAUTHORIZED);
            }

            $this->sessionRepository->setSession($session);
        } catch (AuthException $e) {
            return response()->json(['message' => $e->getMessage()], $e->getCode());
        }

        return $next($request);
    }
}
