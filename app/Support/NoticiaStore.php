<?php

namespace App\Support;

use Illuminate\Support\Str;

class NoticiaStore
{
    protected const KEY = 'noticias';

    /**
     * Todas as publicacoes, mais recentes primeiro.
     */
    public static function all(): array
    {
        $data = ContentStore::get(self::KEY, ContentDefaults::noticias());
        $items = $data['items'] ?? [];

        usort($items, fn ($a, $b) => strcmp((string) ($b['data_publicacao'] ?? ''), (string) ($a['data_publicacao'] ?? '')));

        return $items;
    }

    public static function latest(int $limit): array
    {
        return array_slice(self::all(), 0, $limit);
    }

    /**
     * @param string|null $tipo 'noticia', 'edital' ou null/qualquer outro valor para todas.
     */
    public static function byTipo(?string $tipo): array
    {
        $items = self::all();

        if (! in_array($tipo, ['noticia', 'edital'], true)) {
            return $items;
        }

        return array_values(array_filter($items, fn ($item) => ($item['tipo'] ?? '') === $tipo));
    }

    /**
     * Anos presentes nas publicacoes informadas, do mais recente para o mais
     * antigo. Recebe a lista ja filtrada (por tipo, por exemplo) para nunca
     * oferecer um ano que resultaria em lista vazia.
     *
     * @param array $items publicacoes no formato de self::all()
     * @return int[]
     */
    public static function anos(array $items): array
    {
        $anos = [];

        foreach ($items as $item) {
            $ano = (int) substr((string) ($item['data_publicacao'] ?? ''), 0, 4);
            if ($ano > 0) {
                $anos[$ano] = true;
            }
        }

        $anos = array_keys($anos);
        rsort($anos);

        return $anos;
    }

    /**
     * Filtra as publicacoes informadas por ano de publicacao.
     */
    public static function byAno(array $items, int $ano): array
    {
        return array_values(array_filter(
            $items,
            fn ($item) => (int) substr((string) ($item['data_publicacao'] ?? ''), 0, 4) === $ano
        ));
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

    /**
     * Cria (se 'id' vier vazio) ou atualiza (se 'id' bater com um item existente).
     */
    public static function save(array $item): array
    {
        $data = ContentStore::get(self::KEY, ContentDefaults::noticias());
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

        ContentStore::save(self::KEY, ['items' => $items]);

        return $item;
    }

    public static function delete(string $id): void
    {
        $data = ContentStore::get(self::KEY, ContentDefaults::noticias());
        $items = array_values(array_filter($data['items'] ?? [], fn ($item) => $item['id'] !== $id));

        ContentStore::save(self::KEY, ['items' => $items]);
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
