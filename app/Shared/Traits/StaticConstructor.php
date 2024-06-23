<?php

declare(strict_types=1);

namespace App\Shared\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

/**
 * Trait StaticConstructor
 */
trait StaticConstructor
{
    /**
     * @param array<string,mixed> $data
     * @return static
     */
    public static function fromArray(array $data): static
    {
        return new static(...static::mapFields($data));
    }

    /**
     * @param Model $model
     * @return static
     */
    public static function fromModel(Model $model): static
    {
        return new static(...static::mapFields($model->toArray()));
    }

    public static function fromValidatedRequest(FormRequest $request): static
    {
        return static::fromArray($request->validated());
    }

    /**
     * @param array<string,mixed> $data
     * @return array<string,mixed>
     */
    protected static function mapFields(array $data): array
    {
        $reflection = new \ReflectionClass(static::class);

        $result = [];

        /** @var \ReflectionMethod $constructor */
        $constructor = $reflection->getConstructor();
        $arguments = $constructor->getParameters();

        if (count($arguments) === 0) {
            return [];
        }

        foreach ($arguments as $argument) {
            $default = $argument->isDefaultValueAvailable() ? $argument->getDefaultValue() : null;
            $key = Str::camel($argument->getName());
            $result[$key] = $data[Str::snake($key)] ?? $data[$key] ?? $default;
        }

        return $result;
    }
}
