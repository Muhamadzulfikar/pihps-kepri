<a
    href="javascript:void(0)" data-button-type="delete"
    data-text="Hapus Harga Pasar"
    data-bs-toggle="tooltip" data-bs-placement="top"
    data-bs-title="Hapus Harga Pasar"
    onclick="deleteMarket(this)"
    data-route="{{ url($crud->route.'/'.$entry->uuid.'/markets/'.$market->id) }}"
    class="text-capitalize btn btn-danger"
>
    <i class="la la-trash"></i>
</a>

@push('after_scripts')
    <script>
        async function deleteMarket(button) {
            const route = button.getAttribute('data-route');
            const text = button.getAttribute('data-text');

            const result = await swal({
                title: "Peringatan",
                text: text + "?",
                icon: "warning",
                buttons: {
                    cancel: {
                        text: "Batal",
                        visible: true,
                    },
                    confirm: {
                        text: "Hapus",
                        className: "btn-danger",
                    },
                },
                dangerMode: true,
            });

            if (result) {
                const response = await fetch(route, {
                    method: "delete",
                    headers: {
                        "Content-Type": "application/json",
                        "Accept": "application/json",
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                    },
                });

                const responseStatus = response.status;
                const responseData = await response.json();

                if (responseStatus === 200) {
                    await swal({
                        title: "Sukses",
                        text: "Berhasil Hapus Data",
                        icon: "success",
                        timer: 5000,
                    });
                } else {
                    await swal({
                        title: "Gagal",
                        text: responseData.data.message,
                        icon: "error",
                        timer: 5000,
                    });
                }

                window.location.reload();
            }
        }
    </script>
@endpush
