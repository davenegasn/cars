<x-layouts.main-wrapper>
    <form wire:submit.prevent="save" x-data="">
        <div class="flex">
            <div class="flex-grow-0 flex-shrink-0 w-2/3 md:pr-4">
                <div class="flex flex-row mb-4">
                    <div class="w-full">
                        <x-input
                            label="Titulo"
                            placeholder="Titulo del vehículo"
                            wire:model.live="form.title"
                        />
                    </div>
                </div>
                <div class="mb-4">
                    <x-textarea name="description" label="Especificaciones" wire:model="form.description" placeholder="Descripción del vehículo" />
                    @error('form.description') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                
                <div class="flex items-center justify-items-center flex-row mb-4">
                    <div class="w-1/3 pr-4">
                        <x-native-select wire:model.live="form.sold" label="Vendido" :options="[
                            ['name' => 'No', 'id' => 0],
                            ['name' => 'Si', 'id' => 1],
                            
                        ]" option-label="name" option-value="id" />
                    </div>
                    <div class="w-1/3 pr-4">
                        <x-input
                            label="Precio"
                            placeholder="Precio del vehículo"
                            wire:model.live="form.price"
                            right-icon="currency-dollar"
                            disabled="{{ $form->sold }}"
                        />
                    </div>
                    
                    <div class="w-1/3">
                        <x-select
                            label="Año"
                            placeholder="Seleccionar"
                            :async-data="route('years.api.index')"
                            option-label="year"
                            option-value="id"
                            wire:model.live="form.year_id"
                        />
                        @error('form.year_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    </div>
                </div>

                <div class="flex flex-row mb-4">
                    <div class="w-1/3 pr-4">
                        <x-native-select wire:model="form.condition" label="Condición" :options="[
                            ['name' => 'Nuevo', 'id' => 'Nuevo'],
                            ['name' => 'Usado', 'id' => 'Usado'],
                            
                        ]" option-label="name" option-value="id" />
                    </div>
                    
                    <div class="w-1/3 pr-4">
                        <x-input
                            label="Dirección"
                            placeholder="Dirección del vehículo"
                            wire:model.live="form.address"
                            right-icon="map-pin"
                        />
                    </div>
                    
                    <div class="w-1/3">
                        <x-input
                            label="Dueños"
                            placeholder="Cantidad de dueños"
                            wire:model.live="form.owners"
                            right-icon="users"
                        />
                    </div>
                </div>

                <div class="flex flex-row mb-4">
                    <div class="w-1/3 pr-4">
                        <x-input
                            label="Kilometraje"
                            placeholder=""
                            wire:model="form.kilometraje"
                        />
                    </div>
                    
                    <div class="w-1/3 pr-4">
                        <x-input
                            label="Velocidades"
                            placeholder=""
                            wire:model="form.velocidades"
                        />
                    </div>
                    
                    <div class="w-1/3">
                        <x-input
                            label="Youtube URL"
                            placeholder="URL del Video de YouTube"
                            wire:model="form._video_youtube"
                        />
                    </div>
                </div>
                
                <div class="flex flex-row mb-4">
                    <div class="w-1/2 md:pr-4">
                        <div class="flex flex-row  items-center align-center mb-3">
                            <div class="w-1/2 md:pr-2">
                                <x-native-select
                                    wire:model="form.traccion"
                                    label="Tracción"
                                    placeholder="Seleccionar"
                                    :options="$traccionOptions"
                                />
                            </div>
                            <div class="w-1/2">
                                <x-input label="Agregar" placeholder="Ej: 4x4">
                                    <x-slot name="append">
                                        <x-button
                                            class="h-full"
                                            icon="plus"
                                            rounded="rounded-r-md"
                                            primary
                                        />
                                    </x-slot>
                                </x-input>
                            </div>
                        </div>
                        <div class="flex flex-row  items-center align-center mb-3">
                            <div class="w-1/2 md:pr-2">
                                <x-native-select
                                    wire:model="form.tipo_transmision"
                                    label="Transmisión"
                                    placeholder="Seleccionar"
                                    :options="$tipoTransmisionOptions"
                                />
                            </div>
                            <div class="w-1/2">
                                <x-input label="Agregar" placeholder="Ej: Automática">
                                    <x-slot name="append">
                                        <x-button
                                            class="h-full"
                                            icon="plus"
                                            rounded="rounded-r-md"
                                            primary
                                        />
                                    </x-slot>
                                </x-input>
                            </div>
                        </div>
                        <div class="flex flex-row items-center align-center mb-3">
                            <div class="w-1/2 md:pr-2">
                                <x-native-select
                                    wire:model="form.asientos"
                                    label="Asientos"
                                    placeholder="Seleccionar"
                                    :options="$asientosOptions"
                                />
                            </div>
                            <div class="w-1/2">
                                <x-input label="Agregar" placeholder="Ej: Sin asientos">
                                    <x-slot name="append">
                                        <x-button
                                            class="h-full"
                                            icon="plus"
                                            rounded="rounded-r-md"
                                            primary
                                        />
                                    </x-slot>
                                </x-input>
                            </div>
                        </div>
                    </div>
                    <div class="w-1/2">
                        <div class="flex flex-row items-center align-center mb-3">
                            <div class="w-1/2 md:pr-2">
                                <x-native-select
                                    wire:model="form.carroceria"
                                    label="Carrocería"
                                    placeholder="Seleccionar"
                                    :options="$carroceriaOptions"
                                />
                            </div>
                            <div class="w-1/2">
                                <x-input label="Agregar" placeholder="Ej: Sedán">
                                    <x-slot name="append">
                                        <x-button
                                            class="h-full"
                                            icon="plus"
                                            rounded="rounded-r-md"
                                            primary
                                        />
                                    </x-slot>
                                </x-input>
                            </div>
                        </div>
                        <div class="flex flex-row items-center align-center mb-3">
                            <div class="w-1/2 md:pr-2">
                                <x-native-select
                                    wire:model="form.tipo_combustible"
                                    label="Tipo de combustible"
                                    placeholder="Seleccionar"
                                    :options="$tipoCombustibleOptions"
                                />
                            </div>
                            <div class="w-1/2">
                                <x-input label="Agregar" placeholder="Ej: Diesel">
                                    <x-slot name="append">
                                        <x-button
                                            class="h-full"
                                            icon="plus"
                                            rounded="rounded-r-md"
                                            primary
                                        />
                                    </x-slot>
                                </x-input>
                            </div>
                        </div>
                        <label for="_video_media" class="block text-gray-700 text-sm font-bold mb-2">ID del Video Media</label>
                        <input type="text" name="_video_media" id="_video_media" wire:model="form._video_media" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                        @error('form._video_media') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    
                    </div>
                </div>

                
             
                <div class="flex flex-row">
                    <x-toggle id="wordpress" label="Publicar en Wordpress" class="mr-3" name="wp" md />
                    <x-toggle id="chileautos" label="Publicar en Chileautos" name="ca" md />
                </div>

            </div>
            <aside class="flex-grow-0 flex-shrink-0 w-1/3 md:pl-4 sticky top-0 h-screen md:border-l-2">
                <div class="mb-3">
                <label for="featured_image" class="block text-gray-700 text-sm font-bold mb-2">Imagen Destacada</label>
                    @if ($form->image)
                        <img src="{{ $form->image->temporaryUrl() }}" alt="Featured Image" class=" md:w-full md:h-auto md:aspect-[1/1] object-cover w-60 h-60">
                        <a href="javascript:void(0)" wire:click.prevent="removeImage" class="text-red-500 text-sm">Cancelar</a>
                    @else
                        @if ($form->featured_image)
                            <img src="{{ Storage::url($form->featured_image) }}" alt="Featured Image" class=" md:w-full md:h-auto md:aspect-[1/1] object-cover w-60 h-60">
                        @else
                            <div class="flex items-center justify-center col-span-1 bg-gray-100 shadow-md sm:col-span-2 dark:bg-secondary-700 rounded-xl h-64">
                                <div class="flex flex-col items-center justify-center">
                                    <x-icon name="cloud-arrow-up" class="w-16 h-16 text-blue-600 dark:text-teal-600" />
                                    <p class="cursor-pointer text-blue-600 dark:text-teal-600" onclick="document.getElementById('featured_image').click();">Subir imagen</p>
                                </div>
                                <input type="file" id="featured_image" wire:model.live="form.image" class="hidden">
                                @error('form.featured_image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            </div>
                        @endif
                    @endif
                </div>

                <div class="mb-4 pb-4 md:border-b-2">
                    <x-select
                        label="Marca del Vehículo"
                        placeholder="Seleccionar"
                        :async-data="route('brands.api.index')"
                        option-label="name"
                        option-value="id"
                        wire:model.live="form.brand_id"
                    />
                    @error('form.brand_id') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                    <x-input wire:model="newBrandName" class="pt-2 border-t-2" label="Agregar" placeholder="Nueva marca">
                        <x-slot name="append">
                            <x-button
                                class="h-full"
                                icon="plus"
                                rounded="rounded-r-md"
                                primary
                                wire:click="createBrand"
                            />
                        </x-slot>
                    </x-input>
                </div>
                
                <div class="mb-4 pb-4 md:border-b-2">
                    @foreach($equipmentOptions as $option)
                        <div class="flex items-center">
                            <input 
                                type="checkbox" 
                                value="{{ $option['id'] }}" 
                                wire:model.live="form.equipment" 
                                id="checkbox-{{ $loop->index }}"
                                class="mr-3 ">
                            <label for="checkbox-{{ $loop->index }}">{{ $option['name'] }}</label>
                        </div>
                    @endforeach
                    <x-input wire:model="newEquipment" class="pt-2 border-t-2" label="Agregar" placeholder="Nuevo Equipamiento">
                        <x-slot name="append">
                            <x-button
                                class="h-full"
                                icon="plus"
                                rounded="rounded-r-md"
                                primary
                                wire:click="createEquipment"
                            />
                        </x-slot>
                    </x-input>
                </div>
            </aside>
        </div>

        

        <div class="flex items-center justify-between mt-5">
            <button type="submit" class="bg-emerald-500 hover:bg-emeral-800 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                {{ $edit ? 'Actualizar' : 'Guardar' }}
            </button>
        </div>
    </form>
</x-layouts.main-wrapper>
