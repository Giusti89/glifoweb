<x-guest-layout>
    <link rel="stylesheet" href="../css/login.css">
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />        

     
        <section>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <h1>Inicio</h1>
                <div class="inputbox">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="email" required id="email" name="email" :value="old('email')" required autofocus autocomplete="username">
                    <label for="">Usuario/Email</label>
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
        
                <div class="inputbox">
                    <ion-icon name="mail-outline"></ion-icon>
                    <input type="password" required id="password" name="password" autocomplete="current-password">
                    <label for="">Contraseña</label>
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>             
                <button> <p>Iniciar</p> </button>                             
            </form>
        </section>
    
</x-guest-layout>
