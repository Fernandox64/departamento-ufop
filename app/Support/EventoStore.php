<?php

namespace App\Support;

use Illuminate\Support\Str;

class EventoStore
{
    protected const KEY = 'eventos';

    /**
     * Todos os eventos, do mais proximo para o mais distante.
     */
    public static function all(): array
    {
        $data = ContentStore::get(self::KEY, ContentDefaults::eventos());
        $items = $data['items'] ?? [];

        usort($items, fn ($a, $b) => strcmp((string) ($a['data_evento'] ?? ''), (string) ($b['data_evento'] ?? '')));

        return $items;
    }

    /**
     * Proximos eventos (data igual ou posterior a hoje), limitados a $limit.
     */
    public static function upcoming(int $limit): array
    {
        $hoje = now()->format('Y-m-d');
        $futuros = array_values(array_filter(self::all(), fn ($item) => (string) ($item['data_evento'] ?? '') >= $hoje));

        return array_slice($futuros, 0, $limit);
    }

    public static function find(string $id): ?array
    {
        foreach (self::all() as $item) {
            if ($item['id'] === $id) {
                return $item;
            }
        }

        return null;
    }

    public static function mostrarMenu(): bool
    {
        $data = ContentStore::get(self::KEY, ContentDefaults::eventos());

        return (bool) ($data['mostrar_menu'] ?? false);
    }

    public static function setMostrarMenu(bool $valor): void
    {
        $data = ContentStore::get(self::KEY, ContentDefaults::eventos());
        $data['mostrar_menu'] = $valor;

        ContentStore::save(self::KEY, $data);
    }

    /**
     * Cria (se 'id' vier vazio) ou atualiza (se 'id' bater com um item existente).
     */
    public static function save(array $item): array
    {
        $data = ContentStore::get(self::KEY, ContentDefaults::eventos());
        $items = $data['items'] ?? [];

        if (empty($item['id'])) {
            $item['id'] = self::generateId($items);
        }

        $found = false;
        foreach ($items as $idx => $existing) {
            if ($existing['id'] === $item['id']) {
                $items[$idx] = $item;
                $found = true;
                break;
            }
        }
        if (! $found) {
            $items[] = $item;
        }

        $data['items'] = $items;
        ContentStore::save(self::KEY, $data);

        return $item;
    }

    public static function delete(string $id): void
    {
        $data = ContentStore::get(self::KEY, ContentDefaults::eventos());
        $data['items'] = array_values(array_filter($data['items'] ?? [], fn ($item) => $item['id'] !== $id));

        ContentStore::save(self::KEY, $data);
    }

    protected static function generateId(array $existing): string
    {
        $ids = array_column($existing, 'id');

        do {
            $id = (string) Str::random(8);
        } while (in_array($id, $ids, true));

        return $id;
    }
}
