<?php

namespace App\Support;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Contas da equipe (administrador/secretaria) que podem logar no painel,
 * alem da conta raiz definida no .env (ver config/admin.php). Guardadas em
 * storage/app/private/content/membros.json, mesmo padrao de noticias/eventos.
 */
class MembroStore
{
    protected const KEY = 'membros';

    public static function all(): array
    {
        $data = ContentStore::get(self::KEY, ContentDefaults::membros());

        return $data['items'] ?? [];
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

    public static function findByEmail(string $email): ?array
    {
        foreach (self::all() as $item) {
            if (strcasecmp($item['email'], $email) === 0) {
                return $item;
            }
        }

        return null;
    }

    /**
     * Cria (id vazio) ou atualiza um membro. Espera 'nome', 'email', 'nivel'
     * e opcionalmente 'senha' (texto puro - vira hash aqui dentro; se vier
     * vazia numa atualizacao, mantem a senha anterior).
     */
    public static function save(array $dados): array
    {
        $items = self::all();

        if (empty($dados['id'])) {
            $dados['id'] = self::generateId($items);
            $dados['senha_hash'] = Hash::make($dados['senha']);
        } else {
            $atual = self::find($dados['id']);
            $dados['senha_hash'] = filled($dados['senha'] ?? null)
                ? Hash::make($dados['senha'])
                : ($atual['senha_hash'] ?? '');
        }
        unset($dados['senha']);

        $found = false;
        foreach ($items as $idx => $existing) {
            if ($existing['id'] === $dados['id']) {
                $items[$idx] = $dados;
                $found = true;
                break;
            }
        }
        if (! $found) {
            $items[] = $dados;
        }

        ContentStore::save(self::KEY, ['items' => $items]);

        return $dados;
    }

    public static function delete(string $id): void
    {
        $items = array_values(array_filter(self::all(), fn ($item) => $item['id'] !== $id));

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
