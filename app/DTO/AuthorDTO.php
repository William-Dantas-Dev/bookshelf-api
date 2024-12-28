<?php

namespace App\DTO;

class AuthorDTO
{
    public function __construct(
        public ?int $id,
        public string $name,
        public ?string $biography,
        public ?string $birthDate,
        public ?string $deathDate,
        public ?string $created_at,
        public ?string $updated_at
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            name: $data['name'],
            biography: $data['biography'] ?? null,
            birthDate: $data['birthDate'] ?? null,
            deathDate: $data['deathDate'] ?? null,
            created_at: $data['created_at'] ?? null,
            updated_at: $data['updated_at'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'name' => $this->name,
            'biography' => $this->biography,
            'birthDate' => $this->birthDate,
            'deathDate' => $this->deathDate,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ], fn($value) => $value !== null);
    }
}
