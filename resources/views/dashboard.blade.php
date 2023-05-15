<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Hotéis') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">


                    <h1 class="text-lg font-bold">Sistema de gerenciamento de Hotéis</h1>
                    <p>Seja bem vindo(a) {{ Auth::user()->name}} </p><br>

                    <fieldset class="border p-2 mb-2 border-indigo-500 rounded">
                        <legend class="px-2 border rounded-md border-indigo-500">Adicionar um novo hotel</legend>


                        <form action="{{ route('hotel.store') }}" method="POST" class="mt-2">
                            @csrf

                            <div class="mt-4">
                                <x-input-label for="name" :value="__('Nome:')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" required />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="address" :value="__('Endereço:')" />
                                <x-text-input id="address" class="block mt-1 w-full" type="text" name="address" required />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="number_rooms" :value="__('Quantidade de Quartos:')" />
                                <x-text-input id="number_rooms" class="block mt-1 w-full" type="number" minlength="1" name="number_rooms" required />
                            </div>

                            <div class="mt-4">
                                <x-input-label for="classification" :value="__('Classificação:')" />
                                <select required name="classification">
                                    <option value="1 Estrela">1 Estrela</option>
                                    <option value="2 Estrela">2 Estrelas</option>
                                    <option value="3 Estrela">3 Estrelas</option>
                                    <option value="4 Estrela">4 Estrelas</option>
                                    <option value="5 Estrela">5 Estrelas</option>
                                </select>
                            </div>


                            <div class="mt-4">
                                <x-input-label for="breakfast" :value="__('Café da manhã incluso:')" />
                                <select required name="breakfast">
                                    <option value="Sim">Sim</option>
                                    <option value="Não">Não</option>
                                </select>
                            </div>

                            <x-primary-button class="w-full">Adicionar</x-primary-button>
                        </form>
                    </fieldset>

                    @foreach (Auth::user()->myHotel as $hotel)

                    <div class="flex justify-between border-b mb-2 gap-4 hover:bg-gray-300" x-data=" { showDelete: false, showEdit: false  } ">


                        <div class="flex justify-between flex-grow">
                            <div>Nome: {{ $hotel->name }} </div>
                            <div>Endereço: {{ $hotel->address }} </div>
                            <div>Quantidade de Quartos: {{ $hotel->number_rooms }} </div>
                            <div>Classificação: {{ $hotel->classification }} </div>
                            <div>Café da manhã incluso: {{ $hotel->breakfast}} </div>
                        </div>

                        <div class="flex gap-2">
                            <div>
                                <span class="cursor-pointer px-2 bg-red-500 text-white" @click="showDelete = true ">Apagar</span>
                            </div>
                            <div>
                                <span class="cursor-pointer px-2 bg-blue-500 text-white" @click="showEdit = true ">Editar </span>
                            </div>
                        </div>

                        <template x-if="showDelete">
                            <div class="absolute top-0 button-0 left-0 right-0 bg-gray-800 bg-opacity-20 z-0">
                                <div class="w-96 bg-white p-4 absolute left-1/4 right-1/4 top-1/4 z-10 ">
                                    <h2 class="text-xl font-bold text-center">Você tem certeza que quer apagar?</h2>
                                    <div class="flex justify-between mt-4">
                                        <form action="{{  route('hotel.destroy', $hotel) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <x-danger-button>Apagar</x-danger-button>
                                        </form>
                                        <x-primary-button @click="showDelete = false">Cancelar</x-primary-button>
                                    </div>
                                </div>
                            </div>
                        </template>

                        <template x-if="showEdit">
                            <div class="absolute top-0 button-0 left-0 right-0 bg-gray-800 bg-opacity-20 z-0">
                                <div class="w-96 bg-white p-4 absolute left-1/4 right-1/4 top-1/4 z-10 ">
                                    <h2 class="text-xl font-bold text-center">Hotel: {{ $hotel->name }}</h2>
                                    <form class="my-4" action="{{  route('hotel.update', $hotel) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <x-text-input name="name" placeholder="Nome" value="{{ $hotel->name }}" required> </x-text-input>
                                        <x-text-input name="address" placeholder="Endereço" value="{{ $hotel->address }}" required> </x-text-input>
                                        <x-text-input name="number_rooms" placeholder="Quantidade de Quartos" value="{{ $hotel->number_rooms }}" required> </x-text-input>
                                        <select required name="classification">
                                            <option hidden value="{{ $hotel->classification}}"> {{ $hotel->classification}}</option>
                                            <option value="1 Estrela">1 Estrela</option>
                                            <option value="2 Estrela">2 Estrelas</option>
                                            <option value="3 Estrela">3 Estrelas</option>
                                            <option value="4 Estrela">4 Estrelas</option>
                                            <option value="5 Estrela">5 Estrelas</option>
                                        </select>

                                        <x-input-label for="breakfast" :value="__('Café da manhã incluso:')" ></x-input-label>
                                        <select required name="breakfast">
                                            <option hidden value="{{ $hotel->breakfast }}"> {{ $hotel->breakfast }}</option>
                                            <option value="Sim">Sim</option>
                                            <option value="Não">Não</option>
                                        </select>
                                        <x-primary-button> Editar </x-primary-button>
                                    </form>
                                    <x-primary-button @click="showEdit = false" class="w-full">Cancelar</x-primary-button>
                                </div>
                            </div>
                        </template>
                    </div>
                    @endforeach



                </div>
            </div>
        </div>
    </div>
</x-app-layout>
