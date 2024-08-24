    <!-- Open the modal using ID.showModal() method -->
    <dialog id="my_modal_1" class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold text-center">Create a new Category</h3>
            <form id="createCategoryForm" class=" form_group mt-5">
                <label class="text-sm text-black mb-0" for="categoryName">Category Name</label>
                <input id="categoryName" type="text">
            </form>
            <div class="modal-action">
                <form method="dialog">
                    <button id="catModelClose" class="btn">Close</button>
                </form>
                <button onclick="createCategory()" class="btn_primary">Create</button>
            </div>
        </div>
    </dialog>


    <script>

        async function createCategory(){
            let categoryName = document.getElementById('categoryName').value

            if(categoryName.length === 0 ){
                errorTostr('Please enter category name');
            }else{
                let catModelClose = document.getElementById('catModelClose');
                catModelClose.click();

                showLoder();

                let res = await axios.post('{{ route('createCategory') }}',{
                    categoryName:categoryName
                })

                hideLoder();
                if(res.data['status'] === 'success'){
                    successTostr(res.data.message)
                    document.getElementById('createCategoryForm').reset();
                    await getCategories();
                }else{
                    errorTostr(res.data.message)
                }
            }
        }

    </script>