<!DOCTYPE html>
<html lang="en" dir="rtl" class="h-full bg-white">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Cairo:wght@200..1000&family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: "Cairo", sans-serif;

        }
    </style>
</head>

<body class="h-full">
    <!--
  This example requires updating your template:

  ```
  <html class="h-full bg-white">
  <body class="h-full">
  ```
-->
    <div class="flex min-h-screen flex-col justify-center bg-[#f8fafc] px-6 py-12 lg:px-8" dir="rtl">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div
                class="relative overflow-hidden bg-white px-8 py-12 shadow-[0_8px_30px_rgb(0,0,0,0.04)] rounded-3xl border border-gray-100">
                <div class="absolute top-0 right-0 left-0 h-1.5 bg-indigo-600"></div>

                <div class="sm:mx-auto sm:w-full sm:max-w-sm text-center">
                    <div class="inline-block p-3 rounded-2xl bg-gray-50 mb-4">
                        <img class="w-32 h-auto" src="/assets/img/logo.jpg" alt="Logo">
                    </div>
                    <h2 class="text-2xl font-black text-gray-900">أهلاً بك مجدداً</h2>
                    <p class="mt-2 text-sm text-gray-500 mb-8 font-medium">الرجاء إدخال بياناتك للوصول للوحة التحكم</p>
                </div>

                <form class="space-y-6" action="https://qarara-aid.vercel.app/login" method="POST">
                    @csrf

                    <div>
                        <label for="identity"
                            class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2 mr-1">رقم
                            الهوية</label>
                        <input type="text" name="identity_number" id="identity" inputmode="numeric" pattern="[0-9]*"
                            autocomplete="identity_number" value="{{ old('identity_number', '') }}" required
                            class="block w-full rounded-2xl border-0 bg-gray-100/50 px-4 py-4 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm transition-all outline-none"
                            placeholder="000000000">
                        @error('identity_number')
                            <div class="flex items-center gap-1 mt-2 mr-1 text-red-500">
                                <span class="text-xs font-bold">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div>
                        <label for="password"
                            class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2 mr-1">كلمة
                            المرور</label>
                        <input type="password" name="password" id="password" required
                            class="block w-full rounded-2xl border-0 bg-gray-100/50 px-4 py-4 text-gray-900 ring-1 ring-inset ring-gray-200 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm transition-all outline-none"
                            placeholder="••••••••">
                        @error('password')
                            <div class="flex items-center gap-1 mt-2 mr-1 text-red-500">
                                <span class="text-xs font-bold">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <button type="submit"
                        class="group relative flex w-full justify-center rounded-2xl bg-indigo-600 px-4 py-4 text-sm font-bold text-white transition-all hover:bg-indigo-700 hover:-translate-y-0.5 active:translate-y-0 shadow-lg shadow-indigo-100">
                        <span>تسجيل الدخول</span>
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="h-5 w-5 mr-2 opacity-0 -translate-x-2 transition-all group-hover:opacity-100 group-hover:translate-x-0"
                            fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14" />
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>


</body>

</html>
