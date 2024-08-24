<!-- Open the modal using ID.showModal() method -->
<dialog id="catUpdateModel" class="modal modal-bottom sm:modal-middle">
    <div class="modal-box">
        <h3 class="text-xl font-bold text-center">Update category</h3>
        <form class="catDeleteModelForm mt-5 form_group">
            <input type="hidden" id="categoryIDUpdate">
            <input type="text" id="updateCategoryName">
        </form>
        <div class="modal-action">
            <form method="dialog">
                <!-- if there is a button in form, it will close the modal -->
                <button id="catUpdateModelClose" class="btn">Close</button>
            </form>
            <button onclick="updateCategory()" class="btn_primary">Update</button>
        </div>
    </div>
</dialog>


<script>


    async function getCategoryID(id){

        document.getElementById('categoryIDUpdate').value =id

        showLoder();
        let res = await axios.post('/getCategoryID',{
            categoryID: id
        });
        hideLoder();
        //console.log(res.data);
        document.getElementById('updateCategoryName').value = res.data['categoryName'];
    }



    async function updateCategory(){
        let categoryID = document.getElementById('categoryIDUpdate').value
        let updateCategoryName = document.getElementById('updateCategoryName').value
        if(updateCategoryName.length === 0 ){
            errorTostr('Please enter category name');
        }else{
            showLoder();
            let res = await axios.post('{{ route('updateCategory') }}',{
                categoryID:categoryID,
                categoryName:updateCategoryName
            });
            hideLoder();

            if(res.data['status'] === 'success'){
                successTostr(res.data.message)
                document.getElementById('catUpdateModelClose').click();
                await getCategories();
            }else{
                errorTostr(res.data.message)
            }
        }
    }

</script>
