@extends('partials.admin.main')

@section('title', 'Edit Pegawai')

@section('content')

    ```
    <div class="attendance-page">

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                <i class="bi bi-check-circle me-2"></i>
                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert">
                </button>
            </div>
        @endif

        {{-- Header --}}
        <div class="page-header">

            <div class="page-header-left">

                <div class="header-icon">
                    <i class="bi bi-pencil-square"></i>
                </div>

                <div>
                    <h1 class="page-title">
                        Edit Pegawai
                    </h1>

                    <p class="page-description">
                        Perbarui data pegawai dan fingerprint ID.
                    </p>
                </div>

            </div>

        </div>


        {{-- Form Card --}}
        <div class="attendance-card">

            {{-- Card Header --}}
            <div class="table-header">

                <div>
                    <h5 class="table-title">
                        <i class="bi bi-person-vcard"></i>
                        Data Pegawai
                    </h5>

                    <p class="table-description">
                        Perbarui informasi pegawai sesuai dengan data pada mesin fingerprint.
                    </p>
                </div>

            </div>


            {{-- Form --}}
            <div class="form-container">

                <form action="{{ route('pegawai.update', $pegawai) }}" method="POST">

                    @csrf
                    @method('PUT')

                    <div class="row g-4">

                        {{-- Fingerprint ID --}}
                        <div class="col-md-6">

                            <label for="fingerprint_id" class="form-label">
                                Fingerprint ID / PIN
                                <span class="required">*</span>
                            </label>

                            <div class="input-wrapper">

                                <i class="bi bi-fingerprint input-icon"></i>

                                <input type="number" name="fingerprint_id" id="fingerprint_id"
                                    class="form-control custom-input @error('fingerprint_id') is-invalid @enderror"
                                    value="{{ old('fingerprint_id', $pegawai->fingerprint_id) }}" min="1"
                                    placeholder="Contoh: 15" required>

                            </div>

                            @error('fingerprint_id')
                                <div class="error-message">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="input-help">
                                Pastikan ID ini sama dengan ID/PIN pada mesin Fingerspot.
                            </div>

                        </div>


                        {{-- Nama Pegawai --}}
                        <div class="col-md-6">

                            <label for="nama" class="form-label">
                                Nama Pegawai
                                <span class="required">*</span>
                            </label>

                            <div class="input-wrapper">

                                <i class="bi bi-person input-icon"></i>

                                <input type="text" name="nama" id="nama"
                                    class="form-control custom-input @error('nama') is-invalid @enderror"
                                    value="{{ old('nama', $pegawai->nama) }}" maxlength="255"
                                    placeholder="Contoh: Budi Santoso" required>

                            </div>

                            @error('nama')
                                <div class="error-message">
                                    <i class="bi bi-exclamation-circle"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                            <div class="input-help">
                                Masukkan nama lengkap pegawai.
                            </div>

                        </div>

                    </div>


                    {{-- Form Footer --}}
                    <div class="form-footer">

                        <a href="{{ route('pegawai.index') }}" class="btn-cancel">
                            <i class="bi bi-arrow-left"></i>
                            Kembali
                        </a>

                        <button type="submit" class="btn-save">
                            <i class="bi bi-check-lg"></i>
                            Simpan Perubahan
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>


    <style>
        /* ==============================
           PAGE HEADER
        ============================== */

        .page-header {
            display: flex;
            align-items: center;
            margin-bottom: 24px;
        }

        .page-header-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .header-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: #fff8e9;
            color: #d59b27;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 21px;
        }

        .page-title {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            color: #202633;
        }

        .page-description {
            margin: 4px 0 0;
            color: #8a93a3;
            font-size: 13px;
        }


        /* ==============================
           CARD
        ============================== */

        .attendance-card {
            background: #fff;
            border-radius: 15px;
            border: 1px solid #edf0f5;
            box-shadow: 0 4px 18px rgba(31, 45, 61, .04);
            overflow: hidden;
        }


        /* ==============================
           CARD HEADER
        ============================== */

        .table-header {
            padding: 20px 22px;
            border-bottom: 1px solid #edf0f5;
        }

        .table-title {
            margin: 0;
            display: flex;
            align-items: center;
            gap: 8px;
            color: #252b36;
            font-size: 16px;
            font-weight: 650;
        }

        .table-title i {
            color: #315efb;
            font-size: 17px;
        }

        .table-description {
            margin: 5px 0 0;
            color: #9299a6;
            font-size: 12px;
        }


        /* ==============================
           FORM
        ============================== */

        .form-container {
            padding: 24px 22px;
        }

        .form-label {
            display: block;
            margin-bottom: 8px;
            color: #424956;
            font-size: 13px;
            font-weight: 600;
        }

        .required {
            color: #dc6464;
        }


        /* ==============================
           INPUT
        ============================== */

        .input-wrapper {
            position: relative;
        }

        .input-icon {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 2;
            color: #8d96a5;
            font-size: 16px;
            pointer-events: none;
        }

        .custom-input {
            height: 42px;
            padding-left: 39px;
            padding-right: 13px;
            border: 1px solid #e3e7ed;
            border-radius: 9px;
            color: #3b414c;
            font-size: 13px;
            background: #fff;
            box-shadow: none;
            transition: all .2s ease;
        }

        .custom-input::placeholder {
            color: #b0b6c0;
        }

        .custom-input:hover {
            border-color: #d3d9e2;
        }

        .custom-input:focus {
            border-color: #9db3ff;
            box-shadow: 0 0 0 3px rgba(49, 94, 251, .08);
        }

        .custom-input.is-invalid {
            border-color: #dc6464;
        }

        .custom-input.is-invalid:focus {
            box-shadow: 0 0 0 3px rgba(220, 100, 100, .08);
        }


        /* ==============================
           HELP & ERROR
        ============================== */

        .input-help {
            margin-top: 7px;
            color: #969daa;
            font-size: 11px;
            line-height: 1.5;
        }

        .error-message {
            display: flex;
            align-items: center;
            gap: 5px;
            margin-top: 6px;
            color: #dc6464;
            font-size: 11px;
        }


        /* ==============================
           FORM FOOTER
        ============================== */

        .form-footer {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 8px;
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid #edf0f5;
        }


        /* ==============================
           BUTTON
        ============================== */

        .btn-cancel,
        .btn-save {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            height: 36px;
            padding: 0 13px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 500;
            text-decoration: none;
            transition: all .18s ease;
        }

        .btn-cancel {
            color: #687181;
            background: #fff;
            border: 1px solid #e1e5eb;
        }

        .btn-cancel:hover {
            color: #4f5868;
            background: #f7f8fa;
            border-color: #d7dce4;
        }

        .btn-save {
            color: #fff;
            background: #315efb;
            border: 1px solid #315efb;
            cursor: pointer;
        }

        .btn-save:hover {
            color: #fff;
            background: #264ed8;
            border-color: #264ed8;
            transform: translateY(-1px);
        }

        .btn-cancel i,
        .btn-save i {
            font-size: 13px;
        }


        /* ==============================
           RESPONSIVE
        ============================== */

        @media (max-width: 768px) {

            .page-title {
                font-size: 21px;
            }

            .form-container {
                padding: 20px 16px;
            }

            .form-footer {
                flex-direction: column-reverse;
                align-items: stretch;
            }

            .btn-cancel,
            .btn-save {
                width: 100%;
            }

        }
    </style>
    ```

@endsection
