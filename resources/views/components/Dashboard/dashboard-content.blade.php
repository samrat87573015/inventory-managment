<!-- Content -->
<div class="p-6">

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="flex items-center mb-1">
                        <div  class="text-2xl font-semibold"><span id="productCount"></span></div>
                    </div>
                    <div class="text-sm font-medium text-gray-400">Products</div>
                </div>
            </div>

            <a href="{{route('productPage')}}" class="text-[#f84525] font-medium text-sm hover:text-red-800">View</a>
        </div>
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-4">
                <div>
                    <div class="flex items-center mb-1">
                        <div class="text-2xl font-semibold"><span id="categoryCount"></span></div>
                    </div>
                    <div class="text-sm font-medium text-gray-400">Category</div>
                </div>
            </div>
            <a href="{{route('categoryPage')}}" class="text-[#f84525] font-medium text-sm hover:text-red-800">View</a>
        </div>
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="text-2xl font-semibold mb-1"><span id="customerCount"></span></div>
                    <div class="text-sm font-medium text-gray-400">Customers</div>
                </div>

            </div>
            <a href="{{route('customerPage')}}" class="text-[#f84525] font-medium text-sm hover:text-red-800">View</a>
        </div>
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div id="invoiceCount" class="text-2xl font-semibold mb-1"></div>
                    <div class="text-sm font-medium text-gray-400">Invoice</div>
                </div>

            </div>
            <a href="{{route('invoicePage')}}" class="text-[#f84525] font-medium text-sm hover:text-red-800">View</a>
        </div>
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="text-2xl font-semibold mb-1">$<span id="totalSales"></span></div>
                    <div class="text-sm font-medium text-gray-400">Total Sales</div>
                </div>

            </div>
            <a href="{{route('invoicePage')}}" class="text-[#f84525] font-medium text-sm hover:text-red-800">View</a>
        </div>
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="text-2xl font-semibold mb-1">$<span id="TotalVat"></span></div>
                    <div class="text-sm font-medium text-gray-400">Total Vat</div>
                </div>

            </div>
            <a href="{{route('invoicePage')}}" class="text-[#f84525] font-medium text-sm hover:text-red-800">View</a>
        </div>
        <div class="bg-white rounded-md border border-gray-100 p-6 shadow-md shadow-black/5">
            <div class="flex justify-between mb-6">
                <div>
                    <div class="text-2xl font-semibold mb-1">$<span id="TotalPayable"></span></div>
                    <div class="text-sm font-medium text-gray-400">Total Payable</div>
                </div>

            </div>
            <a href="{{route('invoicePage')}}" class="text-[#f84525] font-medium text-sm hover:text-red-800">View</a>
        </div>
    </div>

</div>
<!-- End Content -->



<script>
    dashboardinfo();
    async function dashboardinfo(){
        showLoder();
        let res = await axios.get('/dashboardHeaderInfo');
        hideLoder();
        console.log(res.data);

        document.getElementById('productCount').innerHTML = res.data.productCount;
        document.getElementById('categoryCount').innerHTML = res.data.categoryCount;
        document.getElementById('customerCount').innerHTML = res.data.customerCount;
        document.getElementById('invoiceCount').innerHTML = res.data.invoiceCount;
        document.getElementById('totalSales').innerHTML = res.data.totalSaleAmount;
        document.getElementById('TotalVat').innerHTML = res.data.TotalVat;
        document.getElementById('TotalPayable').innerHTML = res.data.TotalPayable;
    }
</script>
