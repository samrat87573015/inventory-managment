<div class="customers lg:w-1/3 w-full bg-white px-5 py-5 shadow rounded-md">

    <div class="salePage_ctWrapper">
        <table id="salePage_customerTable">
            <thead>
                <tr>
                    <th>Customer</th>
                    <th>Pick</th>
                </tr>
            </thead>
            <tbody id="salePage_customerList">
                
            </tbody>
        </table>
    </div>


</div>



<script>

    getCustomerList();

    async function getCustomerList(){
        let res = await axios.get('/getCustomerList');

        //console.log(res.data);

        $('#salePage_customerTable').DataTable().destroy();
        $('#salePage_customerList').empty();

        res.data.forEach(function (item, index) {
            let tbodylist = `<tr>
                                <td>${item['customerName']}</td>
                                <td>
                                    <div class="flex gap-3">
                                        <button data-id="${item['id']}" data-name="${item['customerName']}" data-email="${item['customerEmail']}" data-phone="${item['customerPhone']}" data-address="${item['customerAddress']}" class="btn_primary customer_pickBtn">Add</button>
                                    </div>
                                </td>
                            </tr>`

            $('#salePage_customerList').append(tbodylist);
        });

        $('#salePage_customerTable').DataTable({
            order: [[0, 'desc']],
            info: false,
            lengthChange: false,

        });

        $('.customer_pickBtn').on('click', function () {
            let id = $(this).data('id');
            let name = $(this).data('name');
            let email = $(this).data('email');
            let phone = $(this).data('phone');
            let address = $(this).data('address');
            getCustomerById(id,name,email,phone,address);
            
        });

    }
</script>