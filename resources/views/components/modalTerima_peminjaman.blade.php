   <!-- MODAL Terima -->
   <div id="modalJatuhTempo"
       class="hidden fixed inset-0 z-[999] bg-black/50 backdrop-blur-md  flex items-center justify-center">
       <div class="bg-white p-6 rounded-lg w-80">

           <h2 class="text-lg font-bold mb-3">Set Tanggal Jatuh Tempo</h2>

           <form id="formSetujui" method="POST">
               @csrf

               <input type="date" name="tanggal_jatuh_tempo" class="border w-full p-2 mb-3" required>

               <div class="flex justify-end gap-2">
                   <button type="button" onclick="closeModal()" class="bg-gray-400 text-white px-3 py-1 rounded">
                       Batal
                   </button>

                   <button type="submit" class="bg-green-500 text-white px-3 py-1 rounded">
                       Simpan
                   </button>
               </div>
           </form>
       </div>
   </div>
  


   <script>
       function openModal(id) {
           let modal = document.getElementById('modalJatuhTempo');
           let form = document.getElementById('formSetujui');

           form.action = `/peminjaman/setujui/${id}`; // sesuaikan route kamu
           modal.classList.remove('hidden');
       }

       function closeModal() {
           document.getElementById('modalJatuhTempo').classList.add('hidden');
       }
   </script>
