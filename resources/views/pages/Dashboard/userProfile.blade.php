<x-layout.dashboard-layout>

    <div class="p-6">

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h1 class="text-2xl mb-5">User Profile</h1>
            <div class="space-y-4">
                <h3 id="userProfileName" class="text-base"></h3>
                <h3 id="userProfileEmail" class="text-base"></h3>
                <h3 id="userProfileMobile" class="text-base"></h3>
            </div>
        </div>

        <div class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h1 class="text-2xl">Update Profile</h1>

            <div class="w-full rounded-lg dark:border dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <div class="space-y-4 md:space-y-6">
                        <div>
                            <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your name</label>
                            <input type="text" id="name" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Full name">

                        </div>
                        <div>
                            <label for="mobile" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Mobile number</label>
                            <input type="text" id="mobile" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Mobile number" value="{{$data->mobile}}">
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New Password</label>
                            <input type="password" name="password" id="password" placeholder="password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="" value="{{$data->password}}">
                        </div>
                        <div>
                            <label for="confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Confirm password</label>
                            <input type="password" name="confirm-password" id="confirm-password" placeholder="Re enter password" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="" value="{{$data->password}}" >
                        </div>
                        <button type="button" onclick="updateProfile()" class="btn_primary ">Update</button>

                    </div>
                </div>
            </div>

        </div>
    </div>



    <script>

        getProfile();

        async function getProfile(){
            showLoder();
            let res=await axios.get('/getUserProfile')
            hideLoder();

            if(res.data['status']==='success'){

                let data=res.data['data'];

                document.getElementById('name').value=data['name'];
                document.getElementById('mobile').value=data['mobile'];
                document.getElementById('password').value=data['password'];
                document.getElementById('confirm-password').value=data['password'];


                document.getElementById('userProfileName').innerHTML='Name: '+data['name'];
                document.getElementById('userProfileEmail').innerHTML='Email: '+data['email'];
                document.getElementById('userProfileMobile').innerHTML='Mobile: '+data['mobile'];


            }
            else{
                errorToast(res.data['message'])
            }
        }

        async function updateProfile(){

            let name = document.getElementById('name').value
            let mobile = document.getElementById('mobile').value
            let password = document.getElementById('password').value
            let confirmPassword = document.getElementById('confirm-password').value

            if(name.length === 0 ){
                errorTostr('Please enter name')
            }else if(mobile.length === 0 ){
                errorTostr('Please enter mobile')
            }else if(password.length === 0 ){
                errorTostr('Please enter password')
            }else if(confirmPassword.length === 0 ){
                errorTostr('Please enter confirm password')
            }else if(password !== confirmPassword){
                errorTostr('Password and confirm password not match')
            }
            else{
                showLoder();
                let res = await axios.post('{{ route('updateUserProfile') }}', {
                    name: name,
                    mobile: mobile,
                    password: password
                })

                hideLoder();

                if(res.data['status'] === 'success'){

                    successTostr(res.data['message'])
                    await getProfile();
                    await headerProfile();

                }else{
                    errorTostr(res.data['message'])
                }
            }


        }
    </script>

</x-layout.dashboard-layout>
