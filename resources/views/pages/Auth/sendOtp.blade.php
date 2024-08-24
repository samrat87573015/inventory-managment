
<x-layout.layout>
    <section class="bg-gray-50 dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                    <h1 class="text-xl font-bold leading-tight tracking-tight text-gray-900 md:text-2xl dark:text-white">
                        Enter your email to send otp
                    </h1>
                    <div class="space-y-4 md:space-y-6">
                        <div>
                            <label for="email" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Your email</label>
                            <input type="email" name="email" id="email" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="name@company.com" required="">
                        </div>
                        <button onclick="sendOtp()" class="btn_primary">Send otp</button>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script>
        async function sendOtp(){

            let email = document.getElementById('email').value
            if(email.length === 0 ){
                errorTostr('Please enter email')
            }else{
                showLoder()
                let res = await axios.post('{{ route('sendOtp')}}',{
                    email:email
                })
                hideLoder()
                if(res.data['status'] === 'success'){
                    sessionStorage.setItem('email', email)
                    successTostr(res.data.message)
                    setTimeout(() => {
                        window.location.href = '/varify-otp';
                    }, 1000);
                }else{
                    errorTostr(res.data.message)
                }
            }
        }

    </script>
</x-layout.layout>
