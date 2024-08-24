<!-- Open the modal using ID.showModal() method -->
<dialog id="customerUpdateModel" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box">
        <h3 class="text-xl font-bold text-center">Update customer</h3>
        <form id="updateCustomerForm" class=" form_group mt-5">
            <input class="w-full border" type="hidden" id="updateCustomerID">
            <div class="input_item">
                <label class="text-sm text-black mb-0" for="customerNameUpdate">Customer Name</label>
                <input id="customerNameUpdate" type="text" placeholder="Name">
            </div>
            <div class="input_item">
                <label class="text-sm text-black mb-0" for="customerEmailUpdate">Customer Email</label>
                <input id="customerEmailUpdate" type="email" placeholder="Email">
            </div>
            <div class="input_item">
                <label class="text-sm text-black mb-0" for="customerPhoneUpdate">Customer Phone</label>
                <input id="customerPhoneUpdate" type="text" placeholder="Phone">
            </div>
            <div class="input_item">
                <label class="text-sm text-black mb-0" for="customerAddressUpdate">Customer Address</label>
                <input id="customerAddressUpdate" type="text" placeholder="Address">
            </div>
        </form>
        <div class="modal-action">
            <form method="dialog">
                <!-- if there is a button in form, it will close the modal -->
                <button id="customerUpdateModelClose" class="btn">Close</button>
            </form>
            <button onclick="updateCustomer()" class="btn_primary">Update</button>
        </div>
    </div>
</dialog>


<script>


    async function getCustomerID(id){
        document.getElementById('updateCustomerID').value = id;
        showLoder();
        let res = await axios.post('/getCustomerID',{
            customerID: id
        });
        hideLoder();
        console.log(res['data']);
        document.getElementById('customerNameUpdate').value = res.data['customerName'];
        document.getElementById('customerEmailUpdate').value = res.data['customerEmail'];
        document.getElementById('customerPhoneUpdate').value = res.data['customerPhone'];
        document.getElementById('customerAddressUpdate').value = res.data['customerAddress'];
    }



    async function updateCustomer(){
        let customerID = document.getElementById('updateCustomerID').value;
        let updateCustomerName = document.getElementById('customerNameUpdate').value;
        let updateCustomerEmail = document.getElementById('customerEmailUpdate').value;
        let updateCustomerPhone = document.getElementById('customerPhoneUpdate').value;
        let updateCustomerAddress = document.getElementById('customerAddressUpdate').value;

        if(updateCustomerName.length === 0 ){
            errorTostr('Please enter customer name');
        }else if(updateCustomerEmail.length === 0){
            errorTostr('Please enter customer email');
        } else if(updateCustomerPhone.length === 0){
            errorTostr('Please enter customer phone');
        } else if(updateCustomerAddress.length === 0){
            errorTostr('Please enter customer address');
        } else{
            showLoder();
            let res = await axios.post('{{ route('updateCustomer') }}',{
                customerID: customerID,
                customerName: updateCustomerName,
                customerEmail: updateCustomerEmail,
                customerPhone: updateCustomerPhone,
                customerAddress: updateCustomerAddress
            });
            hideLoder();

            if(res.data['status'] === 'success'){
                successTostr(res.data.message)
                document.getElementById('customerUpdateModelClose').click();
                await getCustomerList();
            }else{
                errorTostr(res.data.message)
            }
        }
    }

</script>
