    <!-- Open the modal using ID.showModal() method -->
    <dialog id="customerCreateModel" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold text-center">Create a new Customer</h3>
            <form id="createCustomerForm" class=" form_group mt-5">
                <div class="input_item">
                    <label class="text-sm text-black mb-0" for="customerName">Customer Name</label>
                    <input id="customerName" type="text" placeholder="Name">
                </div>
                <div class="input_item">
                    <label class="text-sm text-black mb-0" for="customerEmail">Customer Email</label>
                    <input id="customerEmail" type="email" placeholder="Email">
                </div>
                <div class="input_item">
                    <label class="text-sm text-black mb-0" for="customerPhone">Customer Phone</label>
                    <input id="customerPhone" type="number" placeholder="Phone">
                </div>
                <div class="input_item">
                    <label class="text-sm text-black mb-0" for="customerAddress">Customer Address</label>
                    <input id="customerAddress" type="text" placeholder="Address">
                </div>
            </form>
            <div class="modal-action">
                <form method="dialog">
                    <button id="customerModelClose" class="btn">Close</button>
                </form>
                <button onclick="createCustomer()" class="btn_primary">Create</button>
            </div>
        </div>
    </dialog>



    <script>
        async function createCustomer(){
            let customerName = document.getElementById('customerName').value;
            let customerEmail = document.getElementById('customerEmail').value;
            let customerPhone = document.getElementById('customerPhone').value;
            let customerAddress = document.getElementById('customerAddress').value;

            if(customerName.length === 0 ){
                errorTostr('Please enter customer name');
            }else if(customerEmail.length === 0 ){
                errorTostr('Please enter customer email');
            }else if(customerPhone.length === 0 ){
                errorTostr('Please enter customer phone');
            }else if(customerAddress.length === 0 ){
                errorTostr('Please enter customer address');
            }else{
                document.getElementById('customerModelClose').click();

                showLoder();
                let res = await axios.post('{{ route('createCustomer') }}',{
                    customerName: customerName,
                    customerEmail: customerEmail,
                    customerPhone: customerPhone,
                    customerAddress: customerAddress
                });
                hideLoder();

                if(res.data.status === 'success'){
                    successTostr(res.data.message)
                    document.getElementById('createCustomerForm').reset();
                    await getCustomerList();
                }else{
                    errorTostr(res.data.message)
                }
            }
        }
    </script>