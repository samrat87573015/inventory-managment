<!-- Open the modal using ID.showModal() method -->
<dialog id="customerDeletedModel" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box">
        <h3 class="text-4xl font-bold text-center text-red-500">Delete!</h3>
        <p class="text-center">Are you sure you want to delete this category? This action cannot be undone.</p>
        <form class="customerDeleteModelForm mt-5">
            <input class="w-full border" type="hidden" name="customerID" id="customerID">
        </form>
        <div class="modal-action">
        <form method="dialog">
            <!-- if there is a button in form, it will close the modal -->
            <button id="customerDeleteModelClose" class="btn">Close</button>
        </form>
        <button onclick="deleteCustomer()" class="btn catDeleteBtn">Delete</button>
        </div>
    </div>
</dialog>


<script>
   async function deleteCustomer(){

        let customerID = document.getElementById('customerID').value;

        if(customerID.length === 0 ){
            errorTostr('Please enter customer ID');
        }else {
            showLoder();
            let res = await axios.post('{{ route('deleteCustomer') }}', {
                customerID: customerID
            });
            hideLoder();
            if (res.data['status'] === 'success') {
                successTostr(res.data['message']);
                document.getElementById('customerDeleteModelClose').click();
                await getCustomerList();
            } else {
                errorTostr(res.data['message']);
            }
        }

    }
</script>


