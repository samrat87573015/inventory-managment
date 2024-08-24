<x-layout.layout>
    <div class="flex w-full h-screen items-center justify-center">
        <div class="max-w-md mx-auto  items-center text-center bg-white px-4 sm:px-8 py-10 rounded-xl shadow">
            <header class="mb-8">
                <h1 class="text-2xl font-bold mb-1">Reset Password Verification</h1>
                <p class="text-[15px] text-slate-500">Enter the 4-digit verification code that was sent to your email</p>
            </header>
            <div id="otp-form">
                <div class="flex items-center justify-center gap-3">
                    <input type="text" id ="otp" maxlength="4" class="w-[50%] h-14 text-center text-2xl font-extrabold text-slate-900 bg-slate-200 border border-transparent hover:border-slate-200 appearance-none rounded p-4 outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100" >
                </div>
                <div class="max-w-[260px] mx-auto mt-4">
                    <button onclick="varifyOtp()"
                            class="w-full inline-flex justify-center whitespace-nowrap rounded-lg bg-indigo-500 px-3.5 py-2.5 text-sm font-medium text-white shadow-sm shadow-indigo-950/10 hover:bg-indigo-600 focus:outline-none focus:ring focus:ring-indigo-300 focus-visible:outline-none focus-visible:ring focus-visible:ring-indigo-300 transition-colors duration-150">Verify
                        OTP</button>
                </div>
            </div>
        </div>
    </div>
    <script>

       async function varifyOtp(){

            let otp = document.getElementById('otp').value
            if(otp.length === 0 ){
                errorTostr('Please enter otp')
            }else if(otp.length !== 4){
                errorTostr('Otp length should be 4')
            } else{
                showLoder();
                let res = await axios.post('{{ route('verifyOtp')}}',{
                    email:sessionStorage.getItem('email'),
                    otp:otp
                })
                hideLoder();
                if(res.data['status'] === 'success'){
                    successTostr(res.data.message)
                    sessionStorage.clear();
                    setTimeout(() => {
                        window.location.href = '/reset-password';
                    }, 1000);
                }else{
                    errorTostr(res.data.message)
                }
            }
        }

    </script>
</x-layout.layout>

