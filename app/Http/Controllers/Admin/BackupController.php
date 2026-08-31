<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Support\BackupManager;
use App\Support\ClamAvScanner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class BackupController extends Controller
{
    public function index()
    {
        return view('admin.backup');
    }

    public function download()
    {
        $zipPath = BackupManager::createZip();

        Log::channel('admin')->info('backup_baixado', [
            'ip' => request()->ip(),
        ]);

        return response()->download($zipPath, basename($zipPath))->deleteFileAfterSend(true);
    }

    public function restore(Request $request)
    {
        $request->validate([
            'backup_arquivo' => ['required', 'file', 'mimes:zip', 'max:61440'],
        ]);

        $arquivo = $request->file('backup_arquivo');

        if (! ClamAvScanner::isSafe($arquivo->getRealPath())) {
            throw ValidationException::withMessages([
                'backup_arquivo' => 'O arquivo enviado foi identificado como potencialmente malicioso pelo antivirus e nao foi restaurado.',
            ]);
        }

        try {
            BackupManager::restoreZip($arquivo);
        } catch (\RuntimeException $e) {
            throw ValidationException::withMessages([
                'backup_arquivo' => $e->getMessage(),
            ]);
        }

        Log::channel('admin')->warning('backup_restaurado', [
            'ip' => $request->ip(),
        ]);

        return back()->with('status', 'Backup restaurado com sucesso! O conteudo do site agora e o mesmo do arquivo enviado.');
    }
}
