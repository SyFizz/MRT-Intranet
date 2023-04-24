<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Création de fiche client') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Créez ici un nouveau client.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDBDILYHSKVyFrSYuy17v2ONnu1KlQNFOA&libraries=places&callback=initAutocomplete" async></script>
    <form method="post" action="{{ route('customer.store') }}" class="mt-6 space-y-6">
        @csrf
        <div>
            <x-input-label for="name" :value="__('Nom/Prénom')" />
            <div class="flex align-middle">
                <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name')" autofocus autocomplete="name" />
                @error('name')
                    @svg('carbon-warning', 'w-7 h-7 align-middle mt-2.5 mx-2 text-red-500')
                    <script>
                        document.getElementById('name').classList.add('border-red-500');
                    </script>
                @enderror
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('E-mail')" />
            <div class="flex align-middle">
                <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email')" autocomplete="username" />
                @error('email')
                @svg('carbon-warning', 'w-7 h-7 align-middle mt-2.5 mx-2 text-red-500')
                <script>
                    document.getElementById('email').classList.add('border-red-500');
                </script>
                @enderror
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('email')" />
        </div>

        <div>
            <x-input-label for="address" :value="__('Adresse postale')" />
            <div class="flex align-middle">
                <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address')" autocomplete="off" />
                @error('address')
                @svg('carbon-warning', 'w-7 h-7 align-middle mt-2.5 mx-2 text-red-500')
                <script>
                    document.getElementById('address').classList.add('border-red-500');
                </script>
                @enderror
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>
        <script>
            let autocomplete;

            /* ------------------------- Initialize Autocomplete ------------------------ */
            function initAutocomplete() {
                const input = document.getElementById("address");
                const options = {
                    componentRestrictions: { country: "FR" }
                }
                autocomplete = new google.maps.places.Autocomplete(input, options);
                autocomplete.addListener("place_changed", onPlaceChange)
            }

            /* --------------------------- Handle Place Change -------------------------- */
            function onPlaceChange() {
                const place = autocomplete.getPlace();
                console.log(place.formatted_address)
                console.log(place.geometry.location.lat())
                console.log(place.geometry.location.lng())
            }
        </script>
        <div>
            <x-input-label for="phone" :value="__('Téléphone')" />
            <div class="flex align-middle">
                <x-text-input id="phone" name="phone" type="tel" class="mt-1 block w-full" :value="old('phone')" autocomplete="phone" />
                @error('phone')
                @svg('carbon-warning', 'w-7 h-7 align-middle mt-2.5 mx-2 text-red-500')
                <script>
                    document.getElementById('phone').classList.add('border-red-500');
                </script>
                @enderror
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('phone')" />
        </div>

        <div>
            <x-input-label for="vat_number" :value="__('Numéro de TVA')" />
            <div class="flex align-middle">
                <x-text-input id="vat_number" name="vat_number" type="text" class="mt-1 block w-full" :value="old('vat_number')" autocomplete="vat_number" />
                @error('vat_number')
                @svg('carbon-warning', 'w-7 h-7 align-middle mt-2.5 mx-2 text-red-500')
                <script>
                    document.getElementById('vat_number').classList.add('border-red-500');
                </script>
                @enderror
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('vat_number')" />
        </div>

        <div>
            <x-input-label for="siret" :value="__('Numéro de SIRET')" />
            <div class="flex align-middle">
                <x-text-input id="siret" name="siret" type="text" class="mt-1 block w-full" :value="old('siret')" autocomplete="siret" />
                @error('siret')
                @svg('carbon-warning', 'w-7 h-7 align-middle mt-2.5 mx-2 text-red-500')
                <script>
                    document.getElementById('siret').classList.add('border-red-500');
                </script>
                @enderror
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('siret')" />
        </div>

        <div>
            <x-input-label for="legal_status" :value="__('Forme juridique')" />
            <div class="flex align-middle">
                <select id="legal_status" name="legal_status" class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                    <option value="EI">EI - Entreprise individuelle</option>
                    <option value="EURL">EURL - Entreprise Unipersonnelle à Responsabilité Limitée</option>
                    <option value="SA">SA - Société anonyme</option>
                    <option value="SARL">SARL - Société à responsabilité limitée</option>
                    <option value="SAS">SAS - Société par actions simplifiée</option>
                    <option value="SASU">SASU - Société par actions simplifiée unipersonnelle</option>
                    <option value="SNC">SNC - Société en nom collectif</option>
                    <option value="SC">SC - Société en commandite</option>
                    <option value="Association">Association</option>
                    <option value="Particulier">Particulier</option>
                </select>
                <script>
                    document.getElementById('legal_status').value = '{{ old('legal_status', 'Particulier') }}';
                </script>
                @error('legal_status')
                @svg('carbon-warning', 'w-7 h-7 align-middle mt-2.5 mx-2 text-red-500')
                <script>
                    document.getElementById('legal_status').classList.add('border-red-500');
                </script>
                @enderror
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('legal_status')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Créer le client') }}</x-primary-button>
        </div>
    </form>
</section>
