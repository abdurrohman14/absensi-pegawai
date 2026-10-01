@extends('partials.admin.main')

@section('title', 'Data Pegawai')

@section('content')

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
                    <i class="bi bi-people"></i>
                </div>

                <div>
                    <h1 class="page-title">Data Pegawai</h1>
                    <p class="page-description">
                        Kelola data pegawai yang terdaftar pada sistem fingerprint.
                    </p>
                </div>
            </div>

            {{-- Button Create --}}
            <div class="page-header-right">
                <a href="{{ route('pegawai.create') }}" class="btn-add">
                    <i class="bi bi-plus-lg"></i>
                    <span>Tambah Pegawai</span>
                </a>
            </div>

        </div>


        {{-- Card Table --}}
        <div class="attendance-card">

            {{-- Table Header --}}
            <div class="table-header">

                <div>
                    <h5 class="table-title">
                        <i class="bi bi-person-vcard"></i>
                        Data Pegawai
                    </h5>

                    <p class="table-description">
                        Daftar pegawai yang terdaftar pada mesin fingerprint.
                    </p>
                </div>

                {{-- Total --}}
                <div class="total-data">
                    <span>Total Pegawai</span>
                    <strong>{{ $pegawais->total() }}</strong>
                </div>

            </div>


            {{-- Table --}}
            <div class="table-container">

                <table class="attendance-table">

                    <thead>
                        <tr>
                            <th class="number-column">No</th>
                            <th>Fingerprint ID</th>
                            <th>Nama Pegawai</th>
                            <th class="action-column">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse ($pegawais as $pegawai)
                            <tr>

                                {{-- No --}}
                                <td class="number-column">
                                    {{ $pegawais->firstItem() + $loop->index }}
                                </td>

                                {{-- Fingerprint ID --}}
                                <td>
                                    <span class="fingerprint-badge">
                                        <i class="bi bi-fingerprint"></i>
                                        {{ $pegawai->fingerprint_id }}
                                    </span>
                                </td>

                                {{-- Nama --}}
                                <td>
                                    <div class="employee-name">

                                        <div class="employee-avatar">
                                            <i class="bi bi-person"></i>
                                        </div>

                                        <span>
                                            {{ $pegawai->nama }}
                                        </span>

                                    </div>
                                </td>

                                {{-- Aksi --}}
                                <td class="action-column">

                                    <div class="action-buttons">

                                        {{-- Detail --}}
                                        <a href="{{ route('pegawai.show', $pegawai->id) }}" class="action-btn action-view"
                                            title="Detail">
                                            <i class="bi bi-eye"></i>
                                        </a>

                                        {{-- Edit --}}
                                        <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="action-btn action-edit"
                                            title="Edit">
                                            <i class="bi bi-pencil"></i>
                                        </a>

                                        {{-- Delete --}}
                                        <form action="{{ route('pegawai.destroy', $pegawai->id) }}" method="POST"
                                            class="d-inline"
                                            onsubmit="return confirm('Yakin ingin menghapus pegawai ini?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit" class="action-btn action-delete" title="Hapus">
                                                <i class="bi bi-trash"></i>
                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="4">

                                    <div class="empty-state">

                                        <div class="empty-icon">
                                            <i class="bi bi-people"></i>
                                        </div>

                                        <h6>Belum Ada Data Pegawai</h6>

                                        <p>
                                            Belum ada pegawai yang terdaftar.
                                        </p>

                                        <a href="{{ route('pegawai.create') }}" class="btn-add btn-add-empty">
                                            <i class="bi bi-plus-lg"></i>
                                            Tambah Pegawai
                                        </a>

                                    </div>

                                </td>
                            </tr>
                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- Pagination --}}
            @if ($pegawais->hasPages())
                <div class="pagination-container">

                    <div class="pagination-info">
                        Menampilkan
                        <strong>{{ $pegawais->firstItem() }}</strong>
                        -
                        <strong>{{ $pegawais->lastItem() }}</strong>
                        dari
                        <strong>{{ $pegawais->total() }}</strong>
                        pegawai
                    </div>

                    <div class="pagination-wrapper">
                        {{ $pegawais->onEachSide(1)->links('pagination::bootstrap-5') }}
                    </div>

                </div>
            @endif

        </div>

    </div>


    <style>
        /* ==============================
           PAGE HEADER
        ============================== */

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;
            margin-bottom: 24px;
        }

        .page-header-left {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .page-header-right {
            flex-shrink: 0;
        }

        .header-icon {
            width: 46px;
            height: 46px;
            border-radius: 12px;
            background: #eef4ff;
            color: #315efb;
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
           BUTTON TAMBAH
        ============================== */

        .btn-add {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 9px 14px;
            border-radius: 9px;
            border: 1px solid #315efb;
            background: #315efb;
            color: #fff;
            text-decoration: none;
            font-size: 13px;
            font-weight: 500;
            transition: all .2s ease;
        }

        .btn-add i {
            font-size: 14px;
        }

        .btn-add:hover {
            background: #264ed8;
            border-color: #264ed8;
            color: #fff;
            transform: translateY(-1px);
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
           TABLE HEADER
        ============================== */

        .table-header {
            padding: 20px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
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
           TOTAL
        ============================== */

        .total-data {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 7px 11px;
            border-radius: 8px;
            background: #f7f9fc;
            border: 1px solid #edf0f5;
            color: #7d8593;
            font-size: 12px;
        }

        .total-data strong {
            color: #315efb;
            font-size: 14px;
        }


        /* ==============================
           TABLE
        ============================== */

        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        .attendance-table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }

        .attendance-table thead th {
            padding: 13px 20px;
            background: #fafbfc;
            border-bottom: 1px solid #edf0f5;
            color: #7d8593;
            font-size: 12px;
            font-weight: 600;
            white-space: nowrap;
        }

        .attendance-table tbody td {
            padding: 14px 20px;
            border-bottom: 1px solid #f1f3f6;
            color: #424956;
            font-size: 13px;
            vertical-align: middle;
        }

        .attendance-table tbody tr {
            transition: background .15s ease;
        }

        .attendance-table tbody tr:hover {
            background: #fbfcff;
        }

        .attendance-table tbody tr:last-child td {
            border-bottom: none;
        }

        .number-column {
            width: 70px;
            text-align: center;
        }

        .action-column {
            width: 130px;
            text-align: center;
        }


        /* ==============================
           FINGERPRINT BADGE
        ============================== */

        .fingerprint-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 5px 9px;
            border-radius: 7px;
            background: #f0f4ff;
            color: #315efb;
            font-size: 12px;
            font-weight: 600;
        }

        .fingerprint-badge i {
            font-size: 13px;
        }


        /* ==============================
           EMPLOYEE
        ============================== */

        .employee-name {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 600;
            color: #303641;
        }

        .employee-avatar {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f0f4ff;
            color: #315efb;
            font-size: 15px;
        }


        /* ==============================
           ACTION BUTTON
        ============================== */

        .action-buttons {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
        }

        .action-btn {
            width: 30px;
            height: 30px;
            padding: 0;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 7px;
            border: 1px solid transparent;
            background: transparent;
            text-decoration: none;
            font-size: 13px;
            transition: all .18s ease;
        }

        .action-view {
            color: #4385e5;
            background: #f1f6ff;
        }

        .action-view:hover {
            color: #fff;
            background: #4385e5;
        }

        .action-edit {
            color: #d59b27;
            background: #fff8e9;
        }

        .action-edit:hover {
            color: #fff;
            background: #d59b27;
        }

        .action-delete {
            color: #dc6464;
            background: #fff2f2;
        }

        .action-delete:hover {
            color: #fff;
            background: #dc6464;
        }


        /* ==============================
           EMPTY STATE
        ============================== */

        .empty-state {
            padding: 55px 20px;
            text-align: center;
        }

        .empty-icon {
            width: 58px;
            height: 58px;
            margin: 0 auto 13px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #f4f6f9;
            color: #9aa2af;
            font-size: 24px;
        }

        .empty-state h6 {
            margin: 0 0 5px;
            color: #3b414c;
            font-size: 14px;
            font-weight: 650;
        }

        .empty-state p {
            margin: 0 0 17px;
            color: #9299a6;
            font-size: 12px;
        }

        .btn-add-empty {
            padding: 8px 13px;
        }


        /* ==============================
           PAGINATION
        ============================== */

        .pagination-container {
            padding: 15px 22px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;
            border-top: 1px solid #edf0f5;
        }

        .pagination-info {
            color: #9299a6;
            font-size: 12px;
        }

        .pagination-info strong {
            color: #555d6b;
            font-weight: 600;
        }

        .pagination-wrapper .pagination {
            margin: 0;
            gap: 4px;
        }

        .pagination-wrapper .page-link {
            min-width: 30px;
            height: 30px;
            padding: 0 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #e8ebf0;
            border-radius: 7px !important;
            color: #687181;
            background: #fff;
            font-size: 12px;
            box-shadow: none;
        }

        .pagination-wrapper .page-link:hover {
            background: #f4f7ff;
            color: #315efb;
            border-color: #dce5ff;
        }

        .pagination-wrapper .page-item.active .page-link {
            background: #315efb;
            border-color: #315efb;
            color: #fff;
        }

        .pagination-wrapper .page-item.disabled .page-link {
            color: #c4c9d1;
            background: #fafbfc;
        }


        /* ==============================
           RESPONSIVE
        ============================== */

        @media (max-width: 768px) {

            .page-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .page-header-right {
                width: 100%;
            }

            .btn-add {
                justify-content: center;
            }

            .table-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .total-data {
                width: 100%;
                justify-content: space-between;
            }

            .pagination-container {
                align-items: flex-start;
                flex-direction: column;
            }

        }
    </style>

@endsection
