<x-layout.layout>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Sign in to your account
                    </h1>
                    <div class="space-y-4 md:space-y-6">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Password</label>
                            <input type="password" name="password" id="password" placeholder="••••••••" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required="">
                        </div>


                        <div class="flex items-center justify-between">

                            <a href="{{route('sendOtpPage')}}" class="text-sm font-medium text-primary-600 hover:underline dark:text-primary-500 text-end">Forgot password?</a>
                        </div>
                        <button onclick="submitLogin()" class="btn_primary">Sign in</button>
                        <p class="text-sm font-light text-gray-500 dark:text-gray-400">
                            Don’t have an account yet? <a href="{{ route('registerPage') }}" class="font-medium text-primary-600 hover:underline dark:text-primary-500">Sign up</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
      </section>


      <script>

        async function submitLogin(){

            let email = document.getElementById('email').value
            let password = document.getElementById('password').value

            if(email.length === 0 ){
                errorTostr('Please enter email')
            }else if(password.length === 0 ){
                errorTostr('Please enter password')
            }else{
                showLoder()
                let res = await axios.post('{{ route('userLogin') }}',{
                    email:email,
                    password:password
                })
                hideLoder()

                if(res.data['status'] === 'success'){
                    successTostr(res.data.message)
                    setTimeout(() => {
                        window.location.href = '{{ route('dashboard') }}';
                    }, 1000);
                }else{
                    errorTostr(res.data.message)
                }
            }
        }

      </script>
</x-layout.layout>
