<x-layout.layout>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Reset Password
                    </h1>
                    <div class="space-y-4 md:space-y-6">
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" id="password" placeholder="Password" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        </div>
                        <div>
                            <label for="Confirm-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"> Confirm Password</label>
                            <input type="password" id="ConfirmPassword" placeholder="Re-enter password" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        </div>

                        <button onclick="resetPassword()" class="btn_primary">Reset Password</button>

                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>

        async function resetPassword(){
            let password = document.getElementById('password').value
            let confirmPassword = document.getElementById('ConfirmPassword').value
            if(password.length === 0 || confirmPassword.length === 0){
                errorTostr('Please enter password')
            }else if(password !== confirmPassword){
                errorTostr('Password and confirm password not match')
            }else{
                showLoder();
                let res = await axios.post('{{ route('resetPassword')}}',{
                    password:password
                });
                hideLoder();
                if(res.data['status'] === 'success'){
                    successTostr(res.data.message)
                    setTimeout(() => {
                        window.location.href = '/login';
                    }, 1000);
                }else{
                    errorTostr(res.data.message)
                }
            }
        }

    </script>
</x-layout.layout>
