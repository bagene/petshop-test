<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Domains\User\Contracts\SessionRepositoryInterface;
use Domains\User\Models\JwtToken;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

final class AdminRoutes
{
    public function __construct(private readonly SessionRepositoryInterface $sessionRepository)
    {
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $this->sessionRepository->getUser();

        // for authenticated users, check if the user is an admin
        if ($user !== null && !$user->is_admin) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $response = $next($request);
        $data = json_decode($response->getContent() ?: '{}', true);

        // for unauthenticated users, check if the token is an admin token
        if (isset($data['data']['token'])) {
            /** @var JwtToken $session */
            $session = $this->sessionRepository->findBy('unique_id', $data['data']['token']);

            if (!$session->user?->is_admin) {
                $this->sessionRepository->delete($session);

                return response()->json(['message' => 'Unauthorized'], 401);
            }
        }

        return $response;
    }
}
