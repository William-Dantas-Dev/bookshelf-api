<?php

namespace App\DTO;

class BookDTO
{
    public function __construct(
        public ?int $id,
        public string $title,
        public string $description,
        public ?string $coverImage,
        public ?string $publicationDate,
        public array $genres_id,
        public array $tags_id,
        public ?int $author_id,
        public ?int $user_id,
        public ?string $created_at,
        public ?string $updated_at,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            id: $data['id'] ?? null,
            title: $data['title'],
            description: $data['description'],
            coverImage: $data['coverImage'] ?? null,
            publicationDate: $data['publicationDate'] ?? null,
            genres_id: $data['genres_id'] ?? [],
            tags_id: $data['tags_id'] ?? [],
            author_id: $data['author_id'] ?? null,
            user_id: $data['user_id'] ?? null,
            created_at: $data['created_at'] ?? null,
            updated_at: $data['updated_at'] ?? null
        );
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'coverImage' => $this->coverImage,
            'publicationDate' => $this->publicationDate,
            'genres_id' => $this->genres_id,
            'tags_id' => $this->tags_id,
            'author_id' => $this->author_id,
            'user_id' => $this->user_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ], fn($value) => $value !== null);
    }
}
