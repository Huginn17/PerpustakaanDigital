<!-- MODAL TOLAK -->
<div id="modalTolak" class="hidden fixed inset-0 z-[999] bg-black/50 backdrop-blur-md  flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg w-96">

        <h2 class="text-lg font-bold mb-3">Alasan Penolakan</h2>

        <form id="formTolak" method="POST">
            @csrf

            <!-- TEMPLATE CEPAT -->
            <div class="mb-3">
                <label class="text-sm font-semibold">Pilih Alasan Cepat:</label>
                <select onchange="setAlasan(this.value)" class="border w-full p-2 mt-1">
                    <option value="">-- Pilih --</option>
                    <option value="Stok buku habis">Stok buku habis</option>
                    <option value="Jumlah pinjaman melebihi batas maksimal (3 buku)">Melebihi batas pinjaman</option>
                </select>
            </div>

            <!-- INPUT MANUAL -->
            <textarea name="alasan" id="inputAlasan" class="border w-full p-2 mb-3" placeholder="Masukkan alasan (opsional)"></textarea>

            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeModalTolak()" class="bg-gray-400 text-white px-3 py-1 rounded">
                    Batal
                </button>

                <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded">
                    Tolak
                </button>
            </div>
        </form>
    </div>
</div>




<script>
    function openModalTolak(id) {
        let modal = document.getElementById('modalTolak');
        let form = document.getElementById('formTolak');

        form.action = `/peminjaman/tolak/${id}`; // sesuaikan route
        modal.classList.remove('hidden');
    }

    function closeModalTolak() {
        document.getElementById('modalTolak').classList.add('hidden');
    }

    function setAlasan(value) {
        document.getElementById('inputAlasan').value = value;
    }
</script>
