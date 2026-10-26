@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-7">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h3 class="fw-bold mb-1">Transaksi Peminjaman Buku</h3>
                <p class="text-muted small mb-0">Catat peminjaman buku oleh anggota perpustakaan.</p>
            </div>
            <a href="{{ route('peminjaman.index') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Kembali
            </a>
        </div>

        <div class="card shadow-sm">
            <div class="card-body p-4">
                <form action="{{ route('peminjaman.store') }}" method="POST">
                    @csrf

                    {{-- TODO:- Buat dropdown select 'anggota_id' untuk memilih anggota peminjam --}}
                    {{--      - Buat dropdown select 'buku_id' untuk memilih buku yang akan dipinjam --}}
                    {{--      - Buat input field 'tanggal_pinjam' bertipe date --}}
                    {{--      - Tampilkan pesan error validasi di bawah setiap input jika ada error (@error) --}}
                    {{--      - Buat tombol submit untuk menyimpan transaksi peminjaman --}}

                    <div class="mb-3">
                        <label for="anggota_id" class="form-label fw-semibold">Pilih Anggota</label>
                        <select class="form-select @error('anggota_id') is-invalid @enderror" id="anggota_id" name="anggota_id">
                            <option value="">-- Pilih Anggota Peminjam --</option>
                            @foreach($anggota as $agt)
                                <option value="{{ $agt->id }}" {{ old('anggota_id') == $agt->id ? 'selected' : '' }}>
                                    {{ $agt->nama }}
                                </option>
                            @endforeach
                        </select>
                        @error('anggota_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="buku_id" class="form-label fw-semibold">Pilih Buku</label>
                        <select class="form-select @error('buku_id') is-invalid @enderror" id="buku_id" name="buku_id">
                            <option value="">-- Pilih Buku yang Dipinjam --</option>
                            @foreach($buku as $bk)
                                <option value="{{ $bk->id }}" {{ old('buku_id') == $bk->id ? 'selected' : '' }}>
                                    {{ $bk->judul }} (Stok: {{ $bk->stok }})
                                </option>
                            @endforeach
                        </select>
                        <small class="text-muted">Hanya buku dengan stok > 0 yang muncul dalam pilihan.</small>
                        @error('buku_id')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="tanggal_pinjam" class="form-label fw-semibold">Tanggal Pinjam</label>
                        <input type="date" class="form-control @error('tanggal_pinjam') is-invalid @enderror" id="tanggal_pinjam" name="tanggal_pinjam" value="{{ old('tanggal_pinjam', date('Y-m-d')) }}">
                        @error('tanggal_pinjam')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">
                        <a href="{{ route('peminjaman.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan Peminjaman</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection