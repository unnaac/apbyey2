<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Lucianotonet\GroqLaravel\Facades\Groq; // Pastikan Facade ini benar

class ChatbotController extends Controller
{
    public function tanyaGroq(Request $request)
    {
        $pesanPengguna = $request->input('message');
        $groqApiKey = env('GROQ_API_KEY'); // Pastikan ini ada di .env dan terbaca

        // Validasi tambahan untuk API Key, bisa juga dilakukan di service provider package jika ada
        if (empty($groqApiKey)) {
            Log::critical('GROQ_API_KEY tidak diatur di environment.');
            return response()->json(['error' => 'Kesalahan konfigurasi server (API Key tidak ada).'], 500);
        }

        if (empty($pesanPengguna)) {
            return response()->json(['error' => 'Pesan tidak boleh kosong.'], 400);
        }

        try {
            // Menggunakan metode yang sesuai dengan dokumentasi package
            $response = Groq::chat()->completions()->create([
                'model' => 'llama3-8b-8192', // Anda bisa menggunakan model ini atau yang dari contoh dokumentasi
                // 'model' => 'gemma-7b-it', // Contoh model lain dari Groq, pastikan model tersedia
                'messages' => [
                    // Opsional: Tambahkan system prompt jika diperlukan
                    // ['role' => 'system', 'content' => 'Anda adalah MinTel, asisten virtual TeluSafe yang ramah dan membantu.'],
                    ['role' => 'user', 'content' => $pesanPengguna],
                    // Jika Anda ingin mengirim riwayat chat:
                    // Pastikan $pesanPengguna adalah array messages jika Anda mengirim riwayat
                    // 'messages' => $arrayPesanDariFrontend,
                ],
                'temperature' => 0.7, // Opsional: Sesuaikan temperature
                'max_tokens' => 1024, // Opsional: Batasi panjang respons
                // 'stream' => false, // Defaultnya false, jika true penanganan respons berbeda
            ]);

            // Struktur respons dari package tampaknya sama dengan API OpenAI, jadi ini seharusnya bekerja:
            if (isset($response['choices'][0]['message']['content'])) {
                $balasanBot = $response['choices'][0]['message']['content'];
                return response()->json(['reply' => trim($balasanBot)]);
            } elseif (isset($response['error'])) {
                // Jika API Groq (melalui package) mengembalikan error secara eksplisit
                Log::error('Groq API (via package) mengembalikan error:', (array) $response['error']);
                $errorMessage = 'AI mengembalikan error: ' . ($response['error']['message'] ?? 'Detail tidak tersedia.');
                return response()->json(['error' => $errorMessage], 500); // Atau status code yang sesuai dari error
            } else {
                // Jika format tidak sesuai harapan sama sekali
                Log::error('Groq API Response (via package) tidak sesuai format yang diharapkan:', (array) $response);
                return response()->json(['error' => 'Gagal mendapatkan balasan dari AI atau format respons tidak dikenali.'], 500);
            }

        } catch (\Lucianotonet\GroqLaravel\Exceptions\GroqException $e) {
            // Menangkap exception spesifik dari package jika ada
            Log::error('GroqException saat memanggil Groq API (via package): ' . $e->getMessage());
            $errorMessage = 'Terjadi kesalahan spesifik pada layanan AI.';
            if (config('app.debug')) {
                $errorMessage .= ' Detail: ' . $e->getMessage();
            }
            return response()->json(['error' => $errorMessage], 500); // Atau status code yang sesuai
        } catch (\Illuminate\Http\Client\RequestException $e) {
            // Tangani error koneksi atau timeout saat request HTTP (jika package menggunakan Laravel HTTP Client di dalamnya)
            Log::error('RequestException saat memanggil Groq API (via package): ' . $e->getMessage());
            return response()->json(['error' => 'Gagal terhubung ke layanan AI. Periksa koneksi atau coba lagi nanti.'], 503);
        } catch (\Exception $e) {
            // Menangkap semua pengecualian lain
            Log::error('Pengecualian umum saat memanggil Groq API (via package): ' . $e->getMessage() . ' di ' . $e->getFile() . ' baris ' . $e->getLine());
            $errorMessage = 'Terjadi kesalahan yang tidak terduga pada server.';
            if (config('app.debug')) {
                $errorMessage .= ' Detail: ' . $e->getMessage();
            }
            return response()->json(['error' => $errorMessage], 500);
        }
    }
}