<?php

namespace App\Http\Middleware;

use Closure;
use Domains\User\Contracts\SessionRepositoryInterface;
use Domains\User\Models\JwtToken;
use Domains\User\Models\User;
use Illuminate\Http\Request;
use Infrastructure\Services\Jwt\Contracts\JwtManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class AuthJwt
{
    public function __construct(
        private readonly JwtManagerInterface $jwtManager,
        private readonly SessionRepositoryInterface $sessionRepository,
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
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        /** @var JwtToken|null $session */
        $session = $this->sessionRepository->findBy('unique_id', $token);

        if (!$session) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $tokenData = $this->jwtManager->parse($token);

        if ($tokenData->getExp() < time()) {
            return response()->json(['message' => 'Token Expired'], 401);
        }

        $this->sessionRepository->setSession($session);

        return $next($request);
    }
}
