<!-- Open the modal using ID.showModal() method -->
<dialog id="invoiceDeletedModel" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box">
        <h3 class="text-4xl font-bold text-center text-red-500">Delete!</h3>
        <p class="text-center">Are you sure you want to delete this category? This action cannot be undone.</p>
        <form class="customerDeleteModelForm mt-5">
            <input class="w-full border" type="hidden" id="invoiceID">
        </form>
        <div class="modal-action">
            <form method="dialog">
                <!-- if there is a button in form, it will close the modal -->
                <button id="invoiceDeleteModelClose" class="btn">Close</button>
            </form>
            <button onclick="deleteInvoice()" class="btn catDeleteBtn">Delete</button>
        </div>
    </div>
</dialog>


<script>
    async function deleteInvoice() {

        let id = document.getElementById('invoiceID').value;

        showLoder();
        let res = await axios.post('{{route('deleteInvoice')}}', {
            'invoiceID': id
        });

        hideLoder();

        if(res.data === 1){
            successTostr('Invoice deleted successfully');
            document.getElementById('invoiceDeleteModelClose').click();
            await getInvoiceList();
        }else {
            errorTostr('invoice not deleted');
        }
    }
</script>
