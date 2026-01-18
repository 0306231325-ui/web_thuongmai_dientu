{{-- ================= THÔNG BÁO HỆ THỐNG ================= --}}
@if(session('success'))
    <div class="container mt-3">
        <div id="autoCloseAlert"
             class="alert alert-success alert-dismissible fade show"
             role="alert">
            {{ session('success') }}
            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    </div>
@endif
{{-- ===================================================== --}}
