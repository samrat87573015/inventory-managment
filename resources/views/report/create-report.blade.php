<x-layout.dashboard-layout>

    <div class="create_report_page p-6">
        <div class="bg-white rounded shadow px-5 !py-5">
            <h1 class="font-bold text-2xl mb-5">Create Sale Report</h1>
            <div class="toDate mb-5">
                <label class="block mb-1" for="">Select From Date</label>
                <input class="w-[300px] px-5 py-2 h-10 border border-gray-300" type="date" name="" id="fromDate">
            </div>
            <div class="fromDate">
                <label class="block mb-1" for="">Select To Date</label>
                <input class="w-[300px] px-5 py-2 h-10 border border-gray-300" type="date" name="" id="ToDate">
            </div>

            <div class="mt-5">
                <button onclick="saleReportDownload()" class="btn_primary">Download</button>
            </div>
        </div>
    </div>


    <script>

        function saleReportDownload(){
            fromDate = document.getElementById('fromDate').value;
            toDate = document.getElementById('ToDate').value;

            if(fromDate.length === 0){
                errorTostr('Please select from date');
            }else if(toDate.length === 0){
                errorTostr('Please select to date');
            }else {
                window.open('/ganaratSale/'+fromDate +'/'+toDate)
            }
        }



    </script>


</x-layout.dashboard-layout>
