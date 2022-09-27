<template>
    <AppLayout title="Militantes">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Lista de Militantes
            </h2>
        </template>
        <div class="py-4 lg:px-4 md:px-2 sm:px-2">
            <div class="mx-auto 2xl:8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <!-- Mensajes Flash -->
                    <section>
                        <div @click="cleanMessage()" mx-auto class="bg-teal-100 border-t-4 border-teal-500 rounded-b text-teal-900 px-4 py-3 shadow-md my-3" role="alert" v-show="$page.props.flash.message">
                            <div class="flex">
                                <div>
                                    <p class="text-sm">{{ $page.props.flash.message }}</p>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Fin Mensajes Flash -->
                    <!-- Encabezado y titulo -->
                    <section>
                        <div class="flex justify-between mx-auto p-4">
                            <div class="w-1/3">
                                <h1 class="font-bold text-xl text-black-800 leading-tight">
                                    Militantes
                                </h1>
                            </div>

                            <div class="pr-2 w-1/3 text-center">
                                <button @click="openModal('registrar')" class="bg-blue-500 text-xs  hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ">Nuevo Militante</button>
                            </div>
                        </div>
                    </section>
                    <!-- Fin Encabezado y titulo Busqueda -->
                    <section>
                        <div class="px-4">
                            <form @submit.prevent="getmilitantes('', '', formbusqueda)" @keyup.enter="getmilitantes('', '', formbusqueda)">
                                <div class="grid xl:grid-cols-3 xl:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="formbusqueda.documento" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Documento
                                        </label>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="formbusqueda.nombre" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Nombre
                                        </label>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="formbusqueda.correo" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Correo
                                        </label>
                                    </div>
                                </div>
                                <div class="grid xl:grid-cols-3 xl:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="formbusqueda.idciudad" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Municipio
                                        </label>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="formbusqueda.movil" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Movil
                                        </label>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <select class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" v-model="formbusqueda.idinscripcion">
                                            <option value="-" >Seleccione</option>
                                            <option v-for="tipomil in arrayInscripciones" :key="tipomil.id" :value="tipomil.id" v-text="tipomil.nombre"></option>
                                        </select>
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Inscripción
                                        </label>
                                    </div>
                                </div>
                                <div class="grid xl:grid-cols-3 xl:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <select class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" v-model="formbusqueda.idgenero">
                                            <option value="-" >Seleccione</option>
                                            <option v-for="dato in arrayGeneros" :key="dato.id" :value="dato.id" v-text="dato.nombre"></option>
                                        </select>
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Género
                                        </label>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <select class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" v-model="formbusqueda.idgrupoetnico">
                                            <option value="-" >Seleccione</option>
                                            <option v-for="dato in arrayGruposetnicos" :key="dato.id" :value="dato.id" v-text="dato.nombre"></option>
                                        </select>
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Grupo Étnico
                                        </label>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <select class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" v-model="formbusqueda.lider">
                                            <option value="-" >-</option>
                                            <option value="1" >Si</option>
                                            <option value="0" >No</option>
                                        </select>
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Líder
                                        </label>
                                    </div>
                                </div>
                                <div class="grid xl:grid-cols-3 xl:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <select class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" v-model="formbusqueda.avalado">
                                            <option value="-" >-</option>
                                            <option value="1" >Si</option>
                                            <option value="0" >No</option>
                                        </select>
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Avalado
                                        </label>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <select class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" v-model="formbusqueda.idcorporacion">
                                            <option value="-" >Seleccione</option>
                                            <option v-for="dato in arrayCorporaciones" :key="dato.id" :value="dato.id" v-text="dato.nombre"></option>
                                        </select>
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Corporación
                                        </label>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <select class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" v-model="formbusqueda.electo">
                                            <option value="-" >-</option>
                                            <option value="1" >Si</option>
                                            <option value="0" >No</option>
                                        </select>
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Electo
                                        </label>
                                    </div>
                                </div>
                                <div class="grid xl:grid-cols-3 xl:gap-6">
                                    <div class="relative z-0 w-full mb-6 group">
                                        <select class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" v-model="formbusqueda.estado">
                                            <option value="-" >Seleccione</option>
                                            <option v-for="dato in arrayEstados" :key="dato.id" :value="dato.id" v-text="dato.nombre"></option>
                                        </select>
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Estado
                                        </label>
                                    </div>
                                    <div class="relative z-0 w-full mb-4 group">
                                        <Datepicker v-model="formbusqueda.fechainicio" :enableTimePicker="false" autoApply placeholder="Fecha inicio" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"/>
                                    </div>
                                    <div class="relative z-0 w-full mb-4 group">
                                        <Datepicker v-model="formbusqueda.fechafin" :enableTimePicker="false" autoApply placeholder="Fecha fin" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"/>
                                    </div>
                                </div>
                                <div class="flex mx-auto">
                                    <button type="button" @click="getmilitantes('', '', formbusqueda)" class="mx-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar</button>
                                    <a  href="#" @click="militantesExport(formbusqueda)">
                                        <svg xmlns="http://www.w3.org/2000/svg"  viewBox="0 0 48 48" class="h-8 w-8"><path fill="#4CAF50" d="M41,10H25v28h16c0.553,0,1-0.447,1-1V11C42,10.447,41.553,10,41,10z"/><path fill="#FFF" d="M32 15H39V18H32zM32 25H39V28H32zM32 30H39V33H32zM32 20H39V23H32zM25 15H30V18H25zM25 25H30V28H25zM25 30H30V33H25zM25 20H30V23H25z"/><path fill="#2E7D32" d="M27 42L6 38 6 10 27 6z"/><path fill="#FFF" d="M19.129,31l-2.411-4.561c-0.092-0.171-0.186-0.483-0.284-0.938h-0.037c-0.046,0.215-0.154,0.541-0.324,0.979L13.652,31H9.895l4.462-7.001L10.274,17h3.837l2.001,4.196c0.156,0.331,0.296,0.725,0.42,1.179h0.04c0.078-0.271,0.224-0.68,0.439-1.22L19.237,17h3.515l-4.199,6.939l4.316,7.059h-3.74V31z"/></svg>
                                    </a>
                                </div>
                            </form>
                        </div>
                    </section>
                    <!-- Tabla de contenido -->
                    <section>
                        <div class="lg:px-4 md:px-2 sm:px-0 py-2 pb-6">
                            <table class="table-fixed w-full">
                                <thead>
                                <tr class="bg-gray-100">
                                    <th class="px-4 py-2 w-1/12 text-sm font-bold hover:bg-blue-500 hover:text-gray-50 rounded-b">
                                        <button @click="getmilitantes(buscar, 'documento')" class="font-bold">
                                            Fecha de ingreso
                                            <div v-show="sortBy == 'nombre'">
                                                <span v-show="!sortOrder">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                                <span v-show="sortOrder">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                      <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </button>
                                    </th>
                                    <th class="px-4 py-2 w-1/12 text-sm font-bold hover:bg-blue-500 hover:text-gray-50 rounded-b">
                                        <button @click="getmilitantes(buscar, 'documento')" class="font-bold">
                                            Inscripción
                                            <div v-show="sortBy == 'nombre'">
                                                <span v-show="!sortOrder">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                                <span v-show="sortOrder">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                      <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </button>
                                    </th>
                                    <th class="px-4 py-2 w-1/12 text-sm font-bold hover:bg-blue-500 hover:text-gray-50 rounded-b">
                                        <button @click="getmilitantes(buscar, 'documento')" class="font-bold">
                                            Documento
                                            <div v-show="sortBy == 'nombre'">
                                                <span v-show="!sortOrder">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                                <span v-show="sortOrder">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                      <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </button>
                                    </th>
                                    <th class="px-4 py-2 w-2/12 text-sm font-bold hover:bg-blue-500 hover:text-gray-50 rounded-b">
                                        <button @click="getmilitantes(buscar, 'nombre')" class="font-bold">
                                            Nombre
                                            <div v-show="sortBy == 'nombre'">
                                                <span v-show="!sortOrder">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                                <span v-show="sortOrder">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                      <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </button>
                                    </th>
                                    <th class="px-4 py-2 w-1/12 text-sm font-bold hover:bg-blue-500 hover:text-gray-50 rounded-b">
                                        <button @click="getmilitantes(buscar, 'documento')" class="font-bold">
                                            Municipio
                                            <div v-show="sortBy == 'nombre'">
                                                <span v-show="!sortOrder">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                                <span v-show="sortOrder">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                      <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </button>
                                    </th>
                                    <th class="px-4 py-2 text-sm w-1/12 font-bold hover:bg-blue-500 hover:text-gray-50 rounded-b">
                                        <button @click="getmilitantes(buscar, 'movil')" class="font-bold">
                                            Celular
                                            <div v-show="sortBy == 'movil'">
                                                <span v-show="!sortOrder">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                                <span v-show="sortOrder">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                      <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </button>
                                    </th>
                                    <th class="px-4 py-2 text-sm w-2/12 font-bold hover:bg-blue-500 hover:text-gray-50 rounded-b">
                                        <button @click="getmilitantes(buscar, 'ciudad.precio')" class="font-bold">
                                            Correo
                                            <div v-show="sortBy == 'ciudad.precio'">
                                                <span v-show="!sortOrder">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                                <span v-show="sortOrder">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                      <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </button>
                                    </th>
                                    <th class="px-4 py-2 w-1/12 text-sm font-bold hover:bg-blue-500 hover:text-gray-50 rounded-b">
                                        <button @click="getmilitantes(buscar, 'documento')" class="font-bold">
                                            Estado
                                            <div v-show="sortBy == 'nombre'">
                                                <span v-show="!sortOrder">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                                <span v-show="sortOrder">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                      <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </button>
                                    </th>
                                    <th class="px-4 py-2 text-sm font-bold w-1/12 hover:bg-blue-500 hover:text-gray-50 rounded-b">
                                        <button @click="getmilitantes(buscar, 'estado')" class="font-bold">
                                            Avalado
                                            <div v-show="sortBy == 'estado'">
                                                <span v-show="!sortOrder">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                                <span v-show="sortOrder">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                      <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                </span>
                                            </div>
                                        </button>
                                    </th>
                                    <th class="lg:px-4 md:px-1 mx-auto py-2 text-sm font-bold lg:w-1/12 md:w-1/11 hover:bg-blue-500 hover:text-gray-50 rounded-b">Acciones</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr :class="user.id === selectedRow ? 'bg-blue-200' : ''"  class="text-center hover:bg-blue-400" @click="rowSelect(user.id)" text-sm v-if="arrayData.data" v-for="(user, id) in arrayData.data" :key="id">
                                    <td class="border px-1 py-2 text-sm truncate" v-text="dateTime(user.fechaingreso)"></td>
                                    <td class="border px-1 py-2 text-sm truncate" v-text="user.tipoinscripcion.nombre"></td>
                                    <td class="border px-1 py-2 text-sm truncate" v-text="user.documento"></td>
                                    <td class="border px-1 py-2 text-sm truncate" v-text="user.full_name.toUpperCase()"></td>
                                    <td class="border px-1 py-2 text-sm truncate" v-text="user.ciudad.nombre"></td>
                                    <td class="border px-1 py-2 text-sm truncate" v-text="user.movil"></td>
                                    <td class="border px-1 py-2 text-sm truncate" v-text="user.correo"></td>
                                    <td class="border px-1 py-2 text-sm truncate" v-text="user.estados.nombre"></td>
                                    <td class="border px-2 py-2 text-sm truncate" v-if="user.avalado">
                                        <span class="inline-flex px-2 text-sm font-semibold leading-5 text-green-800 bg-green-100 rounded-full">
                                            Si
                                        </span>
                                    </td>
                                    <td class="border px-2 py-2 text-sm" v-else>
                                        <span class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                                            No
                                        </span>
                                    </td>
                                    <td class="border px-1 py-1 mx-auto text-center flex items-center">
                                        <button @click="ver(user)" class="hover:bg-green-700 text-green-400 font-bold rounded" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z" />
                                            </svg>
                                        </button>
                                        <button @click="edit(user)" class="hover:bg-blue-700 text-white font-bold rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-400" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </button>
                                        <button @click="deleteRow(user)" class="hover:bg-red-700 text-white font-bold rounded">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-red-400" fill="none"
                                                 viewBox="0 0 24 24" stroke="currentColor">
                                                <path v-if="user.estado" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                <path v-else fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>

                                        </button>
                                    </td>
                                </tr>
                                <tr v-else>
                                    <td class="border px-4 py-2 text-xs text-center" colspan="7"> La consulta no obtuvo datos</td>
                                </tr>
                                </tbody>
                            </table>
                            <!-- Paginacion -->
                            <section class="mt-6">
                                <div v-if="arrayData.links.length > 3">
                                    <div class="flex flex-wrap -mb-1">
                                        <template v-for="(link, p) in arrayData.links" :key="p">
                                            <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                                                 v-html="link.label" />
                                            <button  v-else
                                                     class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500"
                                                     :class="{ 'bg-blue-700 text-white': link.active }"
                                                     v-on:click="this.cambiarPage(link.url, 'militantes', formbusqueda)"
                                                     v-html="link.label" />
                                        </template>
                                    </div>
                                </div>
                            </section>
                            <!-- Paginacion -->
                        </div>
                    </section>
                    <!-- Fin Tabla de contenido -->

                    <!-- Ventana modal Detalles -->
                    <section> <!-- Ventana modal -->
                        <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
                            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                                <div class="fixed inset-0 transition-opacity">
                                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                </div>
                                <!-- This element is to trick the browser into centering the modal contents. -->
                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
                                <div class="inline-block lg:w-8/12 align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">

                                    <!-- Menu Tabs -->
                                    <section>
                                        <div class="border-b border-gray-200 dark:border-gray-700">
                                            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
                                                <li class="mr-2">
                                                    <a href="#" v-on:click="activetab='1'; tituloModalDetalle = 'Información'" v-bind:class="[ activetab === '1' ? ' text-blue-600 border-blue-600 active ' : ' text-gray-400 border-transparent hover:text-gray-900 hover:border-gray-900 ' ]" class="inline-flex p-4 rounded-t-lg border-b-2 group">
                                                        <svg v-bind:class="[ activetab === '1' ? 'group-active:text-blue-600 text-blue-600 ' : ' group-active:text-gray-600 text-gray-400 group-hover:text-gray-500 ']" class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-6-3a2 2 0 11-4 0 2 2 0 014 0zm-2 4a5 5 0 00-4.546 2.916A5.986 5.986 0 0010 16a5.986 5.986 0 004.546-2.084A5 5 0 0010 11z" clip-rule="evenodd"></path>
                                                        </svg>Información
                                                    </a>
                                                </li>
                                                <li class="mr-2" v-if="form.avalado">
                                                    <a href="#" v-on:click="activetab='2'; tituloModalDetalle = 'Detalle Aval'" v-bind:class="[ activetab === '2' ? ' text-blue-600 border-blue-600 active ' : ' text-gray-400 border-transparent hover:text-gray-900 hover:border-gray-900 ' ]" class="inline-flex p-4 rounded-t-lg border-b-2 group">
                                                        <svg v-bind:class="[ activetab === '2' ? 'group-active:text-blue-600 text-blue-600 ' : ' group-active:text-gray-600 text-gray-400 group-hover:text-gray-500 ']" class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M5 3a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2V5a2 2 0 00-2-2H5zM5 11a2 2 0 00-2 2v2a2 2 0 002 2h2a2 2 0 002-2v-2a2 2 0 00-2-2H5zM11 5a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V5zM11 13a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path>
                                                        </svg>Detalle Aval
                                                    </a>
                                                </li>
                                                <li class="mr-2" v-if="form.electo">
                                                    <a href="#" v-on:click="activetab='3'; tituloModalDetalle = 'Detalle Electo'" v-bind:class="[ activetab === '3' ? ' text-blue-600 border-blue-600 active ' : ' text-gray-400 border-transparent hover:text-gray-900 hover:border-gray-900 ' ]" class="inline-flex p-4 rounded-t-lg border-b-2 group">
                                                        <svg v-bind:class="[ activetab === '2' ? 'group-active:text-blue-600 text-blue-600 ' : ' group-active:text-gray-600 text-gray-400 group-hover:text-gray-500 ']" class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z"></path>
                                                        </svg>Detalle Electo
                                                    </a>
                                                </li>
                                                <li class="mr-2" v-if="verMode||editMode">
                                                    <a href="#" v-on:click="activetab='4'; tituloModalDetalle = 'Documentos'" v-bind:class="[ activetab === '4' ? ' text-blue-600 border-blue-600 active ' : ' text-gray-400 border-transparent hover:text-gray-900 hover:border-gray-900 ' ]" class="inline-flex p-4 rounded-t-lg border-b-2 group">
                                                        <svg v-bind:class="[ activetab === '4' ? 'group-active:text-blue-600 text-blue-600 ' : ' group-active:text-gray-600 text-gray-400 group-hover:text-gray-500 ']" class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                                                        </svg>Documentos
                                                    </a>
                                                </li>
                                                <li class="mr-2">
                                                    <a href="#" v-on:click="activetab='5'; getHistorial(form.id); tituloModalDetalle = 'Historial'" v-bind:class="[ activetab === '5' ? ' text-blue-600 border-blue-600 active ' : ' text-gray-400 border-transparent hover:text-gray-900 hover:border-gray-900 ' ]" class="inline-flex p-4 rounded-t-lg border-b-2 group">
                                                        <svg v-bind:class="[ activetab === '5' ? 'group-active:text-blue-600 text-blue-600 ' : ' group-active:text-gray-600 text-gray-400 group-hover:text-gray-500 ']" class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                                                        </svg>Historial
                                                    </a>
                                                </li>
                                                <li class="mr-2">
                                                    <a href="#" v-on:click="activetab='6'; getHistorial(form.id); tituloModalDetalle = 'Cuentas claras'" v-bind:class="[ activetab === '6' ? ' text-blue-600 border-blue-600 active ' : ' text-gray-400 border-transparent hover:text-gray-900 hover:border-gray-900 ' ]" class="inline-flex p-4 rounded-t-lg border-b-2 group">
                                                        <svg v-bind:class="[ activetab === '6' ? 'group-active:text-blue-600 text-blue-600 ' : ' group-active:text-gray-600 text-gray-400 group-hover:text-gray-500 ']" class="mr-2 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M9 2a1 1 0 000 2h2a1 1 0 100-2H9z"></path>
                                                            <path fill-rule="evenodd" d="M4 5a2 2 0 012-2 3 3 0 003 3h2a3 3 0 003-3 2 2 0 012 2v11a2 2 0 01-2 2H6a2 2 0 01-2-2V5zm3 4a1 1 0 000 2h.01a1 1 0 100-2H7zm3 0a1 1 0 000 2h3a1 1 0 100-2h-3zm-3 4a1 1 0 100 2h.01a1 1 0 100-2H7zm3 0a1 1 0 100 2h3a1 1 0 100-2h-3z" clip-rule="evenodd"></path>
                                                        </svg>Cuentas claras
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </section>
                                    <!-- Fin Menu Tabs -->

                                    <!-- Seccion menu 1 -->
                                    <section v-if="activetab ==='1'" >

                                        <button type="button" @click="closeModal()" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="authentication-modal">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        </button>
                                        <div class="">
                                            <h4 v-text="tituloModal" class="text-sm font-bold text-gray-900 px-4 py-4"></h4>
                                        </div>
                                        <hr>
                                        <form>
                                            <div class="bg-white px-4 pt-2 pb-4 sm:p-6 sm:pb-4">
                                                <div class="">
                                                    <section>
                                                        <div class="mt-2 grid grid-cols-1 gap-y-6 sm:grid-cols-3 sm:gap-x-4">
                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Fecha de Ingreso</label>
                                                                <div class="mt-1">
                                                                    <Datepicker v-model="form.fechaingreso" :disabled="verMode" required textInput :enableTimePicker="false" autoApply placeholder="Fecha ingreso" class="border border-gray-700 rounded w-full text-gray-700 leading-tight focus:outline-none focus:shadow-outline"/>
                                                                    <div v-if="$page.props.errors.fechaingreso" class="text-red-500">{{ $page.props.errors.fechaingreso }}</div>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Inscripción Militancia</label>
                                                                <div class="mt-1">
                                                                    <select :disabled="verMode" :class="{'bg-blue-100' : verMode}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="form.idinscripcion">
                                                                        <option value="-" >Seleccione</option>
                                                                        <option v-for="tipomil in arrayInscripciones" :key="tipomil.id" :value="tipomil.id" v-text="tipomil.nombre"></option>
                                                                    </select>
                                                                    <div v-if="$page.props.errors.idinscripcion" class="text-red-500">{{ $page.props.errors.idinscripcion }}</div>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Fecha de nacimiento</label>
                                                                <div class="mt-1">
                                                                    <Datepicker v-model="form.fechanacimiento" textInput :enableTimePicker="false" :disabled="verMode" autoApply placeholder="Fecha nacimiento" class="border border-gray-700 rounded w-full text-gray-700 leading-tight focus:outline-none focus:shadow-outline"/>
                                                                    <div v-if="$page.props.errors.fechanacimiento" class="text-red-500">{{ $page.props.errors.fechanacimiento }}</div>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Nombre</label>
                                                                <div class="mt-1">
                                                                    <input type="text" :disabled="verMode" :class="{'bg-blue-100' : verMode}" v-model="form.nombre" autocomplete="given-name" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                    <div v-if="$page.props.errors.nombre" class="text-red-500">{{ $page.props.errors.nombre }}</div>
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Apellido</label>
                                                                <div class="mt-1">
                                                                    <input type="text" :disabled="verMode" :class="{'bg-blue-100' : verMode}" v-model="form.apellido" autocomplete="family-name" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                    <div v-if="$page.props.errors.apellido" class="text-red-500">{{ $page.props.errors.apellido }}</div>
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Correo</label>
                                                                <div class="mt-1">
                                                                    <input type="text" :disabled="verMode" :class="{'bg-blue-100' : verMode}" v-model="form.correo" autocomplete="street-address" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                    <div v-if="$page.props.errors.correo" class="text-red-500">{{ $page.props.errors.correo }}</div>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Movil</label>
                                                                <div class="mt-1">
                                                                    <input type="text" :disabled="verMode" :class="{'bg-blue-100' : verMode}" v-model="form.movil" autocomplete="street-address" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                    <div v-if="$page.props.errors.movil" class="text-red-500">{{ $page.props.errors.movil }}</div>
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Tipo documento</label>
                                                                <div class="mt-1">
                                                                    <select :disabled="verMode" :class="{'bg-blue-100' : verMode}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="form.idtipos_documento">
                                                                        <option value="-" >Seleccione</option>
                                                                        <option v-for="tipodoc in arrayTiposdocumento" :key="tipodoc.id" :value="tipodoc.id" v-text="tipodoc.nombre_corto"></option>
                                                                    </select>
                                                                    <div v-if="$page.props.errors.idtipos_documento" class="text-red-500">{{ $page.props.errors.idtipos_documento }}</div>
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Documento</label>
                                                                <div class="mt-1">
                                                                    <input type="text" :verMode="editMode" :class="{'bg-blue-100' : verMode}" v-model="form.documento" autocomplete="postal-code" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                    <div v-if="$page.props.errors.documento" class="text-red-500">{{ $page.props.errors.documento }}</div>
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Género</label>
                                                                <div class="mt-1">
                                                                    <select :disabled="verMode" :class="{'bg-blue-100' : verMode}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="form.idgenero">
                                                                        <option value="-" >Seleccione</option>
                                                                        <option v-for="dato in arrayGeneros" :key="dato.id" :value="dato.id" v-text="dato.nombre"></option>
                                                                    </select>
                                                                    <div v-if="$page.props.errors.idgenero" class="text-red-500">{{ $page.props.errors.idgenero }}</div>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Nivel Educativo</label>
                                                                <div class="mt-1">
                                                                    <select :disabled="verMode" :class="{'bg-blue-100' : verMode}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="form.idniveleducativo">
                                                                        <option value="-" >Seleccione</option>
                                                                        <option v-for="tipodoc in arrayNiveleducativo" :key="tipodoc.id" :value="tipodoc.id" v-text="tipodoc.nombre"></option>
                                                                    </select>
                                                                    <div v-if="$page.props.errors.idniveleducativo" class="text-red-500">{{ $page.props.errors.idniveleducativo }}</div>
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Gruop Étnico</label>
                                                                <div class="mt-1">
                                                                    <select :disabled="verMode" :class="{'bg-blue-100' : verMode}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="form.idgrupoetnico">
                                                                        <option value="-" >Seleccione</option>
                                                                        <option v-for="departamento in arrayGruposetnicos" :key="departamento.id" :value="departamento.id" v-text="departamento.nombre"></option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Departamento</label>
                                                                <div class="mt-1">
                                                                    <select :disabled="verMode" :class="{'bg-blue-100' : verMode}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="form.iddepartamento" @change="getCiudades">
                                                                        <option value="-" >Seleccione departamento</option>
                                                                        <option v-for="departamento in arrayDepartamentos" :key="departamento.id" :value="departamento.id" v-text="departamento.nombre"></option>
                                                                    </select>
                                                                    <div v-if="$page.props.errors.iddepartamento" class="text-red-500">{{ $page.props.errors.iddepartamento }}</div>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Ciudad</label>
                                                                <div class="mt-1">
                                                                    <select :disabled="verMode" :class="{'bg-blue-100' : verMode}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="form.idciudad">
                                                                        <option value="-" >Seleccione Ciudad</option>
                                                                        <option v-for="ciudad in arrayCiudades" :key="ciudad.id" :value="ciudad.id" v-text="ciudad.nombre"></option>
                                                                    </select>
                                                                    <div v-if="$page.props.errors.idciudad" class="text-red-500">{{ $page.props.errors.idciudad }}</div>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Dirección</label>
                                                                <div class="mt-1">
                                                                    <input type="email" :disabled="verMode" :class="{'bg-blue-100' : verMode}" v-model="form.direccion" autocomplete="email" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                    <div v-if="$page.props.errors.direccion" class="text-red-500">{{ $page.props.errors.direccion }}</div>
                                                                </div>
                                                            </div>


                                                        </div>
                                                        <div class="mt-2 grid grid-cols-1 gap-y-6 sm:grid-cols-4 sm:gap-x-4">
                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Teléfono</label>
                                                                <div class="mt-1">
                                                                    <input type="text" :disabled="verMode" :class="{'bg-blue-100' : verMode}" v-model="form.telefono" autocomplete="postal-code" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                    <div v-if="$page.props.errors.telefono" class="text-red-500">{{ $page.props.errors.telefono }}</div>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Facebook</label>
                                                                <div class="mt-1">
                                                                    <input type="text" :disabled="verMode" :class="{'bg-blue-100' : verMode}" v-model="form.facebook" autocomplete="postal-code" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                    <div v-if="$page.props.errors.facebook" class="text-red-500">{{ $page.props.errors.facebook }}</div>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Instagram</label>
                                                                <div class="mt-1">
                                                                    <input type="text" :disabled="verMode" :class="{'bg-blue-100' : verMode}" v-model="form.instagram" autocomplete="postal-code" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                    <div v-if="$page.props.errors.instagram" class="text-red-500">{{ $page.props.errors.instagram }}</div>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Twitter</label>
                                                                <div class="mt-1">
                                                                    <input type="text" :disabled="verMode" :class="{'bg-blue-100' : verMode}" v-model="form.twitter" autocomplete="postal-code" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                    <div v-if="$page.props.errors.twitter" class="text-red-500">{{ $page.props.errors.twitter }}</div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="mt-2 grid grid-cols-1 gap-y-6 sm:grid-cols-5 sm:gap-x-4">
                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Discapacitado?</label>
                                                                <div class="mt-1">
                                                                    <Toggle v-model="form.discapacitado" :disabled="verMode"/>
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Víctima conflicto Armado?</label>
                                                                <div class="mt-1">
                                                                    <Toggle v-model="form.victimaconflicto" :disabled="verMode"/>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Lider?</label>
                                                                <div class="mt-1">
                                                                    <Toggle v-model="form.lider" :disabled="verMode"/>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Avalado?</label>
                                                                <div class="mt-1">
                                                                    <Toggle v-model="form.avalado" :disabled="verMode" @change="openAvalado()"/>
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Estado</label>
                                                                <div class="mt-1">
                                                                    <span class="inline-flex px-2 text-sm font-semibold leading-5 text-grey-800 bg-green-100 rounded-full">
                                                                        {{ form.estados.nombre }}
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </section>
                                                </div>
                                            </div>
                                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                                  <button v-show="editMode" @click="cambiarEstado(form.id, 'eliminar')" wire:click.prevent="cambiarEstado()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-red-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-red-500 focus:outline-none focus:border-red-700 focus:shadow-outline-red transition ease-in-out duration-150 sm:text-sm sm:leading-5" >
                                                    Eliminar
                                                  </button>
                                                </span>
                                                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                                  <button v-show="editMode" @click="cambiarEstado(form.id, 'sancionar')" wire:click.prevent="cambiarEstado()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-blue-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5" >
                                                    Sancionar
                                                  </button>
                                                </span>
                                                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                                  <button v-show="editMode" @click="cambiarEstado(form.id, 'aprobar')" wire:click.prevent="cambiarEstado()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-orange-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-orange-500 focus:outline-none focus:border-orange-700 focus:shadow-outline-orange transition ease-in-out duration-150 sm:text-sm sm:leading-5" >
                                                    Aprobar
                                                  </button>
                                                </span>
                                                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                                  <button v-show="newMode" @click="save(form)" wire:click.prevent="save()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" >
                                                    Guardar
                                                  </button>
                                                </span>
                                                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                                  <button v-show="editMode" @click="update(form)" wire:click.prevent="update()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" >
                                                    Actualizar
                                                  </button>
                                                </span>
                                                <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">

                                              <button @click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                                Cancelar
                                              </button>
                                            </span>
                                            </div>
                                        </form>
                                    </section>
                                    <!-- fin menu 1 -->

                                    <!-- Seccion menu 2 -->
                                    <section v-if="activetab ==='2'" >
                                        <!-- Ventana modal Aval -->
                                        <!-- Main modal -->

                                        <button type="button" @click="closeModal()" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="authentication-modal">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        </button>
                                        <div class="">
                                            <h2 v-text="tituloModalDetalle" class="text-xl font-bold text-gray-900 px-4 py-4"></h2>
                                        </div>
                                        <div class="bg-white px-4 pt-2 pb-4 ">
                                            <div class="">
                                                <section>
                                                    <div class="mt-2 grid gap-y-6 ">
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Corporación</label>
                                                            <div class="mt-1">
                                                                <select :disabled="verMode" :class="{'bg-blue-100' : verMode}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="form.idcorporacion">
                                                                    <option value="-" >Seleccione corporación</option>
                                                                    <option v-for="dato in arrayCorporaciones" :key="dato.id" :value="dato.id" v-text="dato.nombre"></option>
                                                                </select>
                                                                <div v-if="$page.props.errors.idcorporacion" class="text-red-500">{{ $page.props.errors.idcorporacion }}</div>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Periodo electoral</label>
                                                            <div class="mt-1">
                                                                <select :disabled="verMode" :class="{'bg-blue-100' : verMode}" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="form.periodo">
                                                                    <option value="0" >Seleccione periodo</option>
                                                                    <option value="2022" >2022 - 2024</option>
                                                                    <option value="2021" >2021 - 2023</option>
                                                                    <option value="2020" >2020 - 2022</option>
                                                                    <option value="2019" >2019 - 2021</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Electo?</label>
                                                            <div class="mt-1">
                                                                <Toggle v-model="form.electo" :disabled="verMode" @change="openElecto()"/>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Observaciones</label>
                                                            <div class="mt-1">
                                                                <textarea v-model="form.observaciones" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Observaciones"></textarea>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                                  <button v-show="newMode" @click="save(form)" wire:click.prevent="save()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" >
                                                    Guardar
                                                  </button>
                                                </span>
                                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                                  <button v-show="editMode" @click="update(form)" wire:click.prevent="update()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" >
                                                    Actualizar
                                                  </button>
                                                </span>
                                            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">

                                              <button @click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                                Cancelar
                                              </button>
                                            </span>
                                        </div>
                                        <!-- Fin Ventana modal Aval -->
                                    </section>
                                    <!-- fin menu 2 -->

                                    <!-- Seccion menu 3 -->
                                    <section v-if="activetab ==='3'" >
                                        <!-- Ventana modal Aval -->
                                        <!-- Main modal -->

                                        <button type="button" @click="closeModal()" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="authentication-modal">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        </button>
                                        <div class="">
                                            <h2 v-text="tituloModalDetalle" class="text-xl font-bold text-gray-900 px-4 py-4"></h2>
                                        </div>
                                        <div class="bg-white px-4 pt-2 pb-4 ">
                                            <div class="">
                                                <section>
                                                    <div class="mt-2 grid gap-y-6 ">
                                                        <section>
                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Cantidad de votos</label>
                                                                <div class="mt-1">
                                                                    <input v-if="form.electo" type="number" :disabled="verMode" :class="{'bg-blue-100' : verMode}" v-model="form.votos" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <label class="block mt-2 text-sm font-medium text-gray-700">Coalición?</label>
                                                                <div class="mt-1">
                                                                    <Toggle v-model="form.coalicion" :disabled="verMode"/>
                                                                </div>
                                                            </div>

                                                            <div v-if="form.coalicion">
                                                                <label class="block text-sm mt-2 font-medium text-gray-700">Nombre coalición</label>
                                                                <div class="mt-1">
                                                                    <input type="text" :disabled="verMode" :class="{'bg-blue-100' : verMode}" v-model="form.nombrecoalicion" autocomplete="email" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                </div>
                                                            </div>

                                                            <div>
                                                                <label class="block text-sm mt-2 font-medium text-gray-700">Renunció?</label>
                                                                <div class="mt-1">
                                                                    <Toggle v-model="form.renuncio" :disabled="verMode"/>
                                                                </div>
                                                            </div>

                                                            <div v-if="form.renuncio">
                                                                <label class="block text-sm mt-2 font-medium text-gray-700">Fecha de renuncia</label>
                                                                <div class="mt-1">
                                                                    <Datepicker v-model="form.fecharenuncia" :enableTimePicker="false" :disabled="verMode" required  autoApply placeholder="Fecha renuncia" class="border border-gray-700 rounded w-full text-gray-700 leading-tight focus:outline-none focus:shadow-outline"/>
                                                                </div>
                                                            </div>

                                                            <div v-if="form.renuncio">
                                                                <label class="block text-sm mt-2 font-medium text-gray-700">Remplazo</label>
                                                                <div class="mt-1">
                                                                    <input type="text" :disabled="verMode" :class="{'bg-blue-100' : verMode}" v-model="form.idremplazonombre" @keyup.enter="selectRemplazo(form.idremplazonombre)" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                                </div>
                                                            </div>
                                                        </section>
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Observaciones</label>
                                                            <div class="mt-1">
                                                                <textarea v-model="form.observaciones" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Observaciones"></textarea>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                                  <button v-show="newMode" @click="save(form)" wire:click.prevent="save()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" >
                                                    Guardar
                                                  </button>
                                                </span>
                                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                                  <button v-show="editMode" @click="update(form)" wire:click.prevent="update()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" >
                                                    Actualizar
                                                  </button>
                                                </span>
                                            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">

                                              <button @click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                                Cancelar
                                              </button>
                                            </span>
                                        </div>
                                        <!-- Fin Ventana modal Aval -->
                                    </section>
                                    <!-- fin menu 3 -->

                                    <!-- Seccion menu 4 -->
                                    <section v-if="activetab ==='4'" >
                                        <!-- Ventana modal Documentos -->
                                        <!-- Main modal -->

                                        <button type="button" @click="closeModal()" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="authentication-modal">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        </button>
                                        <div class="">
                                            <h2 v-text="tituloModalDetalle" class="text-xl font-bold text-gray-900 px-4 py-4"></h2>
                                        </div>
                                        <div class="bg-white px-4 pt-2 pb-4 ">
                                            <div class="">
                                                <section>
                                                    <div class="mt-2 grid gap-y-6 flex ">
                                                        <form @submit.prevent="submit" enctype="multipart/form-data">
                                                            <div>
                                                                <label class="block text-sm font-medium text-gray-700">Tipo de archivo</label>
                                                                    <select class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="archivoform.idtipoarchivo">
                                                                        <option value="0" >Seleccione</option>
                                                                        <option v-for="dato in arrayTiposarchivos" :key="dato.id" :value="dato.id" v-text="dato.nombre"></option>
                                                                    </select>
                                                            </div>
                                                            <div>
                                                                <div class="mt-1">
                                                                    <input v-model="archivoform.idmilitante" type="hidden">
                                                                    <input @change="onFileChange" type="file" name="file" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-black-500 sm:text-sm">
                                                                </div>
                                                            </div>

                                                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                                                <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                                                  <button wire:click.prevent="submit()" @click="subirArchivo(archivoform)" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" >
                                                                    Adicionar
                                                                  </button>
                                                                </span>
                                                            </div>
                                                        </form>




                                                        <section>
                                                            <div class="lg:px-4 md:px-2 sm:px-0 py-2 pb-6">
                                                                <table class="table-fixed w-full">
                                                                    <thead>
                                                                    <tr class="bg-gray-100 hover:bg-blue-500 hover:text-gray-50">
                                                                        <th class="px-4 py-2 w-1/12 text-sm font-bold rounded-b">
                                                                            <button @click="getRifas(buscar, 'loteria.nombre')" class="font-bold">
                                                                                Tipo Archivo
                                                                                <div v-show="sortBy == 'loteria.nombre'">
                                                                                <span v-show="!sortOrder">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                                                    </svg>
                                                                                </span>
                                                                                <span v-show="sortOrder">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                                                      <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                                                                    </svg>
                                                                                </span>
                                                                                </div>
                                                                            </button>
                                                                        </th>
                                                                        <th class="px-4 py-2 w-1/12 text-sm font-bold rounded-b">
                                                                            <button @click="getRifas(buscar, 'serie')" class="font-bold">
                                                                                Nombre
                                                                                <div v-show="sortBy == 'serie'">
                                                                                <span v-show="!sortOrder">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                                                    </svg>
                                                                                </span>
                                                                                                        <span v-show="sortOrder">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                                                      <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                                                                    </svg>
                                                                                </span>
                                                                                </div>
                                                                            </button>
                                                                        </th>
                                                                        <th class="px-4 py-2 w-1/12 text-sm font-bold rounded-b">
                                                                            <button @click="getRifas(buscar, 'serie')" class="font-bold">
                                                                                Extensión
                                                                                <div v-show="sortBy == 'serie'">
                                                                                <span v-show="!sortOrder">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                                                    </svg>
                                                                                </span>
                                                                                    <span v-show="sortOrder">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                                                      <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                                                                    </svg>
                                                                                </span>
                                                                                </div>
                                                                            </button>
                                                                        </th>
                                                                        <th class="px-4 py-2 w-1/12 text-sm font-bold rounded-b">
                                                                            <button @click="getRifas(buscar, 'serie')" class="font-bold">
                                                                                Fecha actualización
                                                                                <div v-show="sortBy == 'serie'">
                                                                                <span v-show="!sortOrder">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                                                    </svg>
                                                                                </span>
                                                                                    <span v-show="sortOrder">
                                                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                                                      <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                                                                    </svg>
                                                                                </span>
                                                                                </div>
                                                                            </button>
                                                                        </th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                    <tr @click="descargarArchivo(militante.url)" class="hover:bg-blue-100 text-center" text-sm v-if="arrayArchivos" v-for="(militante, id) in arrayArchivos" :key="id">
                                                                        <td class="border px-1 py-2 text-sm truncate" v-text="militante.tipoarchivo.nombre"></td>
                                                                        <td class="border px-1 py-2 text-sm truncate" v-text="militante.nombre"></td>
                                                                        <td class="border px-1 py-2 text-sm truncate" v-text="militante.extension"></td>
                                                                        <td class="border px-1 py-2 text-sm truncate" v-text="dateTimeFull(militante.updated_at)"></td>
                                                                    </tr>
                                                                    <tr v-else>
                                                                        <td class="border px-4 py-2 text-xs text-center" colspan="4"> La consulta no obtuvo datos</td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>




                                                            </div>
                                                        </section>


                                                    </div>
                                                </section>
                                            </div>
                                        </div>

                                        <!-- Fin Ventana modal Documentos -->
                                    </section>
                                    <!-- fin menu 4 -->

                                    <!-- Seccion menu 5 -->
                                    <section v-if="activetab ==='5'" >
                                        <!-- Ventana modal Historial -->
                                        <!-- Main modal -->

                                        <button type="button" @click="closeModal()" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="authentication-modal">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        </button>
                                        <div class="flex">
                                            <h2 v-text="tituloModalDetalle" class="text-xl font-bold text-gray-900 px-4 py-4"></h2>
                                            <a href="#" @click="isOpenregHistorial = !isOpenregHistorial">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                        </div>

                                        <div class="bg-white px-4 pt-2 pb-4 ">

                                            <section>
                                                <div class="lg:px-4 md:px-2 sm:px-0 py-2 pb-6">
                                                    <table class="table-fixed w-full">
                                                        <thead>
                                                        <tr class="bg-gray-100 hover:bg-blue-500 hover:text-gray-50">
                                                            <th class="px-4 py-2 w-1/12 text-sm font-bold rounded-b">
                                                                <button @click="getRifas(buscar, 'loteria.nombre')" class="font-bold">
                                                                    Fecha
                                                                    <div v-show="sortBy == 'loteria.nombre'">
                                                                    <span v-show="!sortOrder">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                                        </svg>
                                                                    </span>
                                                                        <span v-show="sortOrder">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                                          <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                                                        </svg>
                                                                    </span>
                                                                    </div>
                                                                </button>
                                                            </th>
                                                            <th class="px-4 py-2 w-1/12 text-sm font-bold rounded-b">
                                                                <button @click="getRifas(buscar, 'serie')" class="font-bold">
                                                                    Tipo Historial
                                                                    <div v-show="sortBy == 'serie'">
                                                                    <span v-show="!sortOrder">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                                        </svg>
                                                                    </span>
                                                                        <span v-show="sortOrder">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                                          <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                                                        </svg>
                                                                    </span>
                                                                    </div>
                                                                </button>
                                                            </th>
                                                            <th class="px-4 py-2 w-1/12 text-sm font-bold rounded-b">
                                                                <button @click="getRifas(buscar, 'serie')" class="font-bold">
                                                                    Id Usuario
                                                                    <div v-show="sortBy == 'serie'">
                                                                    <span v-show="!sortOrder">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                                        </svg>
                                                                    </span>
                                                                        <span v-show="sortOrder">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                                          <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                                                        </svg>
                                                                    </span>
                                                                    </div>
                                                                </button>
                                                            </th>
                                                            <th class="px-4 py-2 w-1/12 text-sm font-bold rounded-b">
                                                                <button @click="getRifas(buscar, 'serie')" class="font-bold">
                                                                    Observaciones
                                                                    <div v-show="sortBy == 'serie'">
                                                                    <span v-show="!sortOrder">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                                        </svg>
                                                                    </span>
                                                                        <span v-show="sortOrder">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                                          <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                                                        </svg>
                                                                    </span>
                                                                    </div>
                                                                </button>
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <tr @click="verHistorial(dato.observaciones)" class="hover:bg-blue-100 text-center" text-sm v-if="arrayHistorial" v-for="(dato, id) in arrayHistorial.data" :key="id">
                                                            <td class="border px-1 py-2 text-sm truncate" v-text="dateTimeFull(dato.updated_at)"></td>
                                                            <td class="border px-1 py-2 text-sm truncate" v-text="dato.tipo.nombre"></td>
                                                            <td class="border px-1 py-2 text-sm truncate" v-text="dato.usuario.full_name"></td>
                                                            <td class="border px-1 py-2 text-sm truncate" v-text="dato.observaciones"></td>
                                                        </tr>
                                                        <tr v-else>
                                                            <td class="border px-4 py-2 text-xs text-center" colspan="4"> La consulta no obtuvo datos</td>
                                                        </tr>
                                                        </tbody>
                                                    </table>

                                                </div>
                                            </section>

                                        </div>

                                        <!-- Fin Ventana modal Documentos -->
                                    </section>
                                    <!-- fin menu 5 -->

                                    <!-- Seccion menu 6 -->
                                    <section v-if="activetab ==='6'" >
                                        <!-- Ventana modal Aval -->
                                        <!-- Main modal -->

                                        <button type="button" @click="closeModal()" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="authentication-modal">
                                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                        </button>
                                        <div class="">
                                            <h2 v-text="tituloModalDetalle" class="text-xl font-bold text-gray-900 px-4 py-4"></h2>
                                        </div>
                                        <div class="bg-white px-4 pt-2 pb-4 ">
                                            <div class="">
                                                <section>
                                                    <div class="mt-2 grid gap-y-6 ">
                                                        <div class="relative z-0 w-full mb-4 group">
                                                            <label class="block text-sm font-medium text-gray-700">Fecha solicitud</label>
                                                            <Datepicker v-model="form.cccreated_at" :disabled="form.ccestado != 4" :enableTimePicker="false" autoApply placeholder="Fecha solicitud" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"/>
                                                        </div>
                                                        <div v-if="form.ccestado != 4">
                                                            <div class="relative z-0 w-full mb-4 group">
                                                                <label class="block text-sm font-medium text-gray-700">Fecha reposición de votos</label>
                                                                <Datepicker v-model="form.ccupdated_at" :disabled="form.ccestado == 1" :enableTimePicker="false" autoApply placeholder="Fecha repposición" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"/>
                                                            </div>

                                                            <label class="block text-sm mt-2 font-medium text-gray-700">Reposición de votos</label>
                                                            <div class="mt-1">
                                                                <input type="text" :disabled="verMode" :class="{'bg-blue-100' : verMode}" v-model="form.ccreposicion" class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Observaciones</label>
                                                            <div class="mt-1">
                                                                <textarea v-model="form.ccobservaciones" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500" placeholder="Observaciones"></textarea>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                              <button v-show="form.ccestado == 4" @click="ccsolicitar(form)" wire:click.prevent="save()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" >
                                                Solicitar
                                              </button>
                                            </span>
                                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                                  <button v-show="form.ccestado == 3" @click="ccreposicion(form)" wire:click.prevent="update()" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" >
                                                    Reposición
                                                  </button>
                                                </span>
                                            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">

                                              <button @click="closeModal()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                                Cancelar
                                              </button>
                                            </span>
                                        </div>
                                        <!-- Fin Ventana modal Aval -->
                                    </section>
                                    <!-- fin menu 6 -->

                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Fin Ventana modal Detalles -->



                    <!-- Ventana modal buscar remplazo-->
                    <section>
                        <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpenRemplazo">
                            <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                                <div class="fixed inset-0 transition-opacity" @click="closeModalRemplazo()">
                                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                </div>

                                <!-- This element is to trick the browser into centering the modal contents. -->
                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>

                                <!-- Contenido modal -->
                                <div class="inline-block lg:w-6/12 align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                    <button type="button" @click="closeModalRemplazo()" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="authentication-modal">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    </button>
                                    <section>
                                        <div class="flex justify-between mx-auto p-4">
                                            <div class="w-1/2">
                                                <h1 class="font-bold text-xl text-black-800 leading-tight">
                                                    Buscar Militantes Remplazo
                                                </h1>
                                            </div>

                                            <div class="w-1/2 pr-2">
                                                <div class="container flex justify-center items-center">
                                                    <div class="relative">
                                                        <div class="absolute top-4 left-3">
                                                            <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i> </div>
                                                            <input type="text" v-model="buscarmilitante" @keyup.enter="getmilitantes(buscarmilitante,'documento')" class="h-8 w-26 pl-4 pr-4 rounded-lg z-0 focus:shadow focus:outline-none" placeholder="Buscar (documento, nombre)">
                                                            <button @click="getmilitantes(buscarmilitante,'documento, nombre', true)">
                                                            <div class="absolute top-2 right-2">
                                                                <Icon icon="fe:search" class="h-4"  />
                                                            </div>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </section>
                                    <!-- Fin Encabezado y titulo -->
                                    <!-- Tabla de contenido -->
                                    <section>
                                        <div class="lg:px-4 md:px-2 sm:px-0 py-2 pb-6">
                                            <table class="table-fixed w-full">
                                                <thead>
                                                <tr class="bg-gray-100 hover:bg-blue-500 hover:text-gray-50">
                                                    <th class="px-4 py-2 w-2/12 text-sm font-bold rounded-b">
                                                        <button @click="getRifas('', 'idloteria')" class="font-bold">
                                                            Nombre
                                                            <div v-show="sortBy == 'idloteria'">
                                                            <span v-show="!sortOrder">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                                </svg>
                                                            </span>
                                                                <span v-show="sortOrder">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                                  <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                                                </svg>
                                                            </span>
                                                            </div>
                                                        </button>
                                                    </th>
                                                    <th class="px-4 py-2 w-1/12 text-sm font-bold rounded-b">
                                                        <button @click="getRifas(buscar, 'loteria.nombre')" class="font-bold">
                                                            Documento
                                                            <div v-show="sortBy == 'loteria.nombre'">
                                                            <span v-show="!sortOrder">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                                </svg>
                                                            </span>
                                                                <span v-show="sortOrder">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                                  <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                                                </svg>
                                                            </span>
                                                            </div>
                                                        </button>
                                                    </th>
                                                    <th class="px-4 py-2 w-1/12 text-sm font-bold rounded-b">
                                                        <button @click="getRifas(buscar, 'serie')" class="font-bold">
                                                            Movil
                                                            <div v-show="sortBy == 'serie'">
                                                            <span v-show="!sortOrder">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                                </svg>
                                                            </span>
                                                                <span v-show="sortOrder">
                                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                                  <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                                                                </svg>
                                                            </span>
                                                            </div>
                                                        </button>
                                                    </th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr @click="onSelectRemplazo(militante)" class="hover:bg-blue-100 text-center" text-sm v-if="arrayData.data" v-for="(militante, id) in arrayData.data" :key="id">
                                                    <td class="border px-1 py-2 text-sm truncate" v-text="militante.full_name"></td>
                                                    <td class="border px-1 py-2 text-sm truncate" v-text="militante.documento"></td>
                                                    <td class="border px-1 py-2 text-sm truncate" v-text="militante.movil"></td>
                                                </tr>
                                                <tr v-else>
                                                    <td class="border px-4 py-2 text-xs text-center" colspan="4"> La consulta no obtuvo datos</td>
                                                </tr>
                                                </tbody>
                                            </table>

                                            <!-- Paginacion -->
                                            <section class="mt-6">
                                                <div v-if="arrayData.links.length > 3">
                                                    <div class="flex flex-wrap -mb-1">
                                                        <template v-for="(link, p) in arrayData.links" :key="p">
                                                            <div v-if="link.url === null" class="mr-1 mb-1 px-4 py-3 text-sm leading-4 text-gray-400 border rounded"
                                                                 v-html="link.label" />
                                                            <button  v-else
                                                                     class="mr-1 mb-1 px-4 py-3 text-sm leading-4 border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500"
                                                                     :class="{ 'bg-blue-700 text-white': link.active }"
                                                                     v-on:click="this.cambiarPage(link.url, 'militantes')"
                                                                     v-html="link.label" />
                                                        </template>
                                                    </div>
                                                </div>
                                            </section>
                                            <!-- Paginacion -->


                                        </div>
                                    </section>
                                    <!-- Fin form -->
                                </div>
                                <!-- Fin Contenido modal -->
                            </div>
                        </div>
                    </section>
                    <!-- Fin Ventana modal buscar remplazo -->

                    <!-- Ventana modal cambiar estado -->
                    <!-- Main modal -->
                    <section> <!-- Ventana modal -->
                        <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpenCambioestado">
                            <div class="items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                                <div class="fixed inset-0 transition-opacity">
                                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                </div>

                                <!-- This element is to trick the browser into centering the modal contents. -->
                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
                                <div class="inline-block lg:w-6/12 align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                    <button type="button" @click="isOpenCambioestado = !isOpenCambioestado" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="authentication-modal">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    </button>
                                    <div class="">
                                        <h2 class="text-xl font-bold text-gray-900 px-4 py-4">Cambiar estado {{ formestado.tipo }}</h2>
                                    </div>
                                    <form @submit.prevent="submit">
                                        <div class="bg-white px-4 pt-2 pb-4 ">
                                            <div class="">
                                                <section>
                                                    <div class="mt-2 grid gap-y-6 ">
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Observacion</label>
                                                            <div class="mt-1">
                                                                <textarea rows="4" v-model="formestado.observaciones" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                              <button wire:click.prevent="updateEstado()" @click="updateEstado(formestado)" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" >
                                                Aceptar
                                              </button>
                                            </span>
                                            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">

                                          <button @click="closeModalPass()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                            Cancelar
                                          </button>
                                        </span>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Fin Ventana modal cambiar estado -->

                    <!-- Ventana modal ver historial -->
                    <!-- Main modal -->
                    <section> <!-- Ventana modal -->
                        <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpenverHistorial">
                            <div class="items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                                <div class="fixed inset-0 transition-opacity">
                                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                </div>

                                <!-- This element is to trick the browser into centering the modal contents. -->
                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
                                <div class="inline-block lg:w-6/12 align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                    <button type="button" @click="isOpenverHistorial = !isOpenverHistorial" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="authentication-modal">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    </button>
                                    <div class="">
                                        <h2 class="text-xl font-bold text-gray-900 px-4 py-4">Observaciones</h2>
                                    </div>
                                        <div class="bg-white px-4 pt-2 pb-4 ">
                                            <div class="">
                                                <section>
                                                    <div class="mt-2 grid gap-y-6 ">
                                                        <div>
                                                            <div class="mt-1">
                                                                <div class="mt-1">
                                                                    <textarea rows="4" v-text="verHistorialobs" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Fin Ventana modal ver historial -->

                    <!-- Ventana modal ver historial -->
                    <!-- Main modal -->
                    <section> <!-- Ventana modal -->
                        <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpenregHistorial">
                            <div class="items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">

                                <div class="fixed inset-0 transition-opacity">
                                    <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
                                </div>

                                <!-- This element is to trick the browser into centering the modal contents. -->
                                <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>
                                <div class="inline-block lg:w-6/12 align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
                                    <button type="button" @click="isOpenregHistorial = !isOpenregHistorial" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white" data-modal-toggle="authentication-modal">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                    </button>
                                    <div class="">
                                        <h2 class="text-xl font-bold text-gray-900 px-4 py-4">Registrar actividad</h2>
                                    </div>
                                    <form @submit.prevent="submit">
                                        <div class="bg-white px-4 pt-2 pb-4 ">
                                            <div class="">
                                                <section>
                                                    <div class="mt-2 grid gap-y-6 ">
                                                        <label class="block text-sm font-medium text-gray-700">Tipo de actividad</label>

                                                        <div class="relative z-0 w-full mb-6 group">
                                                            <select class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="formestado.tipo">
                                                                <option value="-" >Seleccione</option>
                                                                <option v-for="tipomil in arrayTipohistorial" :key="tipomil.id" :value="tipomil.id" v-text="tipomil.nombre"></option>
                                                            </select>
                                                        </div>
                                                        <div>
                                                            <label class="block text-sm font-medium text-gray-700">Observacion</label>
                                                            <div class="mt-1">
                                                                <textarea rows="4" v-model="formestado.observaciones" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500"></textarea>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </section>
                                            </div>
                                        </div>
                                        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                                            <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                                              <button wire:click.prevent="registroHistorial()" @click="registroHistorial(form.id, formestado.tipo, formestado.observaciones)" type="button" class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5" >
                                                Aceptar
                                              </button>
                                            </span>
                                            <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">

                                          <button @click="closeModalPass()" type="button" class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">
                                            Cancelar
                                          </button>
                                        </span>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Fin Ventana modal ver hitorial -->

                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from '@/Layouts/AppLayout.vue';
import Swal from "sweetalert2";
import { Icon } from '@iconify/vue';
import Toggle from '@vueform/toggle';
import '@vueform/toggle/themes/default.css';
import Button from "../../Jetstream/Button";
import moment from 'moment'
import { QuillEditor } from '@vueup/vue-quill';
import '@vueup/vue-quill/dist/vue-quill.snow.css';
import { ref, onMounted } from 'vue';
import { Money3Component } from 'v-money3'
import {Head, Link, usePage} from '@inertiajs/inertia-vue3';
import JetNavLink from '@/Jetstream/NavLink.vue';
import NavLink from "../../Jetstream/NavLink";
import Input from "../../Jetstream/Input";

export default {

    components: {
        Input,
        NavLink,
        Button,
        AppLayout,
        Icon,
        Toggle,
        QuillEditor,
        JetNavLink,
        Link,
        money3: Money3Component,
    },
    props:{
        militantes : [],
        errors: Object
    },
    computed: {

    },
    data() {
        return {
            verHistorialobs: null,
            activetab: '1',
            tituloModal: '',
            tituloModalDetalle: '',
            formpasswd: {
                _token: usePage().props.value._token,
                id: '',
                password: '',
                password_confirmation: '',
            },
            form: {
                id: null,
                nombre: '',
                correo: null,
                username: null,
                apellido: null,
                estado: 3,
                idtipos_documento: '-',
                documento: null,
                direccion: null,
                iddepartamento: '-',
                idciudad: '-',
                idpais: 1,
                observaciones: null,
                movil: null,
                url: false,
                cambiarpassword: true,
                idgenero: '-',
                idniveleducativo: '-',
                idgrupoetnico: '-',
                discapacitado: 0,
                victimaconflicto: 0,
                idinscripcion: '-',
                lider: 0,
                avalado: 0,
                idcorporacion: '-',
                periodo: 0,
                electo: 0,
                votos: 0,
                coalicion: 0,
                facebook: null,
                twitter: null,
                instagram: null,
                nombrecoalicion: null,
                renuncio: 0,
                fecharenuncia: null,
                fechanacimiento: null,
                idremplazo: null,
                estados: [],
                ccestado: null,
                ccreposicion: null,
                ccobservaciones: null,
                cccreated_at: null,
                ccupdated_at: null,
            },
            formbusqueda: {
                id: null,
                nombre: '',
                correo: null,
                username: null,
                apellido: null,
                idrol: 0,
                idtipos_documento: 0,
                documento: null,
                direccion: null,
                iddepartamento: 0,
                idciudad: null,
                idpais: 1,
                observaciones: null,
                movil: null,
                url: false,
                cambiarpassword: true,
                idgenero: '-',
                idinscripcion: '-',
                idniveleducativo: '-',
                idgrupoetnico: '-',
                discapacitado: '-',
                victimaconflicto: '-',
                lider: '-',
                avalado: '-',
                idcorporacion: '-',
                periodo: '-',
                electo: '-',
                estado: '-',
                votos: 0,
                coalicion: '-',
                nombrecoalicion: null,
                renuncio: '-',
                fecharenuncia: null,
                idremplazo: null,
                fechainicio: null,
                fechafin: null
            },
            formestado: {
                idmilitante: null,
                estado: null,
                tipo: null,
                observaciones: null
            },
            archivoform: {
                idmilitante: 0,
                file: '',
                idtipoarchivo: 0
            }
        }
    },
    methods: {
        onFileChange(e){
            //console.log(e.target.files[0]);
            this.archivoform.file = e.target.files[0];
        },
        cambiarPass: function(){
            this.isOpencambiopass = true;
        } ,
        updatePass: function(data) {
            this.$inertia.post('/changepasssu', data, {
                onSuccess: (page) => {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Se ha cambiado la contraseña',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.formpasswd.id = 0;
                    this.formpasswd.password = '';
                    this.formpasswd.password_confirmation = '';
                    this.isOpencambiopass = false;
                    this.getmilitantes('','nombre');
                    this.editMode = false;
                    this.closeModal();
                },
            });
        },
        openModal: function (accion, data = []) {
            this.isOpen = true;
            this.reset();
            this.getDepartamentos();
            this.getTiposdocumento();
            switch (accion) {
                case 'registrar': {
                    this.form.fechaingreso = Date.now();
                    this.tituloModal = 'Crear nuevo Militante';
                    this.form.idpais = 1;
                    this.form.iddepartamento = '-';
                    this.form.idciudad = '-';
                    this.form.idtipos_documento = '-';
                    this.form.idgenero = '-';
                    this.form.idniveleducativo = '-';
                    this.form.idgrupoetnico = '-';
                    this.form.idcorporacion = '-';
                    this.form.idremplazo = null;
                    this.form.idremplazonombre = null;
                    this.form.estado = 3;
                    this.ccestado = 4;
                    this.newMode = true;
                    this.verMode = false;
                    this.editMode = false;
                    break;
                }
                case 'ver': {
                    this.tituloModal = 'Ver Usuario ' + data['nombre'] + ' ' + data['apellido'];
                    this.form.id = data['id'];
                    this.form.fechaingreso = data['fechaingreso'];
                    this.form.idpais = data['idpais'];
                    this.form.iddepartamento = data['iddepartamento'];
                    this.getCiudades();
                    this.form.idciudad = data['idciudad'];
                    this.form.idtipos_documento = data['idtipos_documento'];
                    this.form.nombre = data['nombre'];
                    this.form.apellido = data['apellido'];
                    this.form.correo = data['correo'];
                    this.form.movil = data['movil'];
                    this.form.documento = data['documento'];
                    this.form.direccion = data['direccion'];
                    this.form.telefono = data['telefono'];
                    this.form.observaciones = data['observaciones'];
                    this.form.idgenero = data['idgenero'];
                    this.form.idinscripcion = data['idinscripcion'];
                    this.form.idniveleducativo = data['idniveleducativo'];
                    this.form.idgrupoetnico = data['idgrupoetnico'];
                    this.form.discapacitado = data['discapacitado'];
                    this.form.victimaconflicto = data['victimaconflicto'];
                    this.form.lider = data['lider'];
                    this.form.avalado = data['avalado'];
                    this.form.idcorporacion = data['idcorporacion'];
                    this.form.periodo = data['periodo'];
                    this.form.electo = data['electo'];
                    this.form.estado = data['estado'];
                    this.form.votos = data['votos'];
                    this.form.coalicion = data['coalicion'];
                    this.form.nombrecoalicion = data['nombrecoalicion'];
                    this.form.renuncio = data['renuncio'];
                    this.form.twitter = data['twitter'];
                    this.form.facebook = data['facebook'];
                    this.form.instagram = data['instagram'];
                    this.form.fecharenuncia = data['fecharenuncia'];
                    this.form.idremplazo = data['idremplazo'];
                    this.form.idremplazonombre = data['remplazo']?(data['remplazo']['documento'] + ' - ' + data['remplazo']['full_name']):'';
                    this.form.fechainicio = data['fechainicio'];
                    this.form.fechafin = data['fechafin'];
                    this.form.fechanacimiento = data['fechanacimiento'];
                    this.form.estados = data['estados'];
                    this.form.ccestado = data['ccestado'];
                    this.form.ccreposicion = data['ccreposicion'];
                    this.form.ccobservaciones = data['ccobservaciones'];
                    this.form.cccreated_at = data['cccreated_at'];
                    this.form.ccupdated_at = data['ccupdated_at'];
                    this.newMode = false;
                    this.verMode = true;
                    this.editMode = false;
                    break;
                }
                case 'actualizar': {
                    this.tituloModal = 'Editar Usuario ' + data['nombre'] + ' ' + data['apellido'];
                    this.form.id = data['id'];
                    this.form.fechaingreso = data['fechaingreso'];
                    this.form.idpais = data['idpais'];
                    this.form.iddepartamento = data['iddepartamento'];
                    this.getCiudades();
                    this.form.idciudad = data['idciudad'];
                    this.form.idtipos_documento = data['idtipos_documento'];
                    this.form.nombre = data['nombre'];
                    this.form.apellido = data['apellido'];
                    this.form.correo = data['correo'];
                    this.form.movil = data['movil'];
                    this.form.documento = data['documento'];
                    this.form.direccion = data['direccion'];
                    this.form.telefono = data['telefono'];
                    this.form.observaciones = data['observaciones'];
                    this.form.idgenero = data['idgenero'];
                    this.form.idinscripcion = data['idinscripcion'];
                    this.form.idniveleducativo = data['idniveleducativo'];
                    this.form.idgrupoetnico = data['idgrupoetnico'];
                    this.form.discapacitado = data['discapacitado'];
                    this.form.victimaconflicto = data['victimaconflicto'];
                    this.form.lider = data['lider'];
                    this.form.estado = data['estado'];
                    this.form.avalado = data['avalado'];
                    this.form.idcorporacion = data['idcorporacion'];
                    this.form.twitter = data['twitter'];
                    this.form.facebook = data['facebook'];
                    this.form.instagram = data['instagram'];
                    this.form.periodo = data['periodo'];
                    this.form.electo = data['electo'];
                    this.form.votos = data['votos'];
                    this.form.estados = data['estados'];
                    this.form.coalicion = data['coalicion'];
                    this.form.nombrecoalicion = data['nombrecoalicion'];
                    this.form.renuncio = data['renuncio'];
                    this.form.fecharenuncia = data['fecharenuncia'];
                    this.form.idremplazo = data['idremplazo'];
                    this.form.idremplazonombre = data['remplazo']?(data['remplazo']['documento'] + ' - ' + data['remplazo']['full_name']):'';
                    this.form.fechainicio = data['fechainicio'];
                    this.form.fechafin = data['fechafin'];
                    this.form.fechanacimiento = data['fechanacimiento'];
                    this.form.ccestado = data['ccestado'];
                    this.form.ccreposicion = data['ccreposicion'];
                    this.form.ccobservaciones = data['ccobservaciones'];
                    this.form.cccreated_at = data['cccreated_at'];
                    this.form.ccupdated_at = data['ccupdated_at'];
                    break;
                }
            }
        },
        openAvalado: function () {
            if (this.form.avalado == 1 && this.newMode) {
                this.tituloModalDetalle = 'Detalle de Avalado';
                this.isOpenAval = true;
                this.activetab = '2';
            }
        },
        openElecto: function () {
            if (this.form.electo == 1 && this.newMode) {
                this.tituloModalDetalle = 'Detalle de Electo';
                this.activetab = '3';
            }
        },
        verDetalleAvalado: function () {
            this.tituloModalDetalle = 'Detalle de Avalado';
            this.isOpenAval = true;
        },
        selectRemplazo: function (documento) {
            this.isOpenRemplazo = true;
            this.getmilitantes(documento,'documento',);
        },
        onSelectRemplazo: function(data){
            this.closeModalRemplazo();
            this.form.idremplazo = data.id;
            this.form.idremplazonombre = data.documento + ' - ' + data.full_name;
        },
        closeModal: function () {
            this.isOpen = false;
            this.reset();
            this.editMode = false;
            this.verMode  = false;
            this.newMode  = false;
            this.$page.props.errors = [];
            this.activetab = '1';
        },
        closeModalRemplazo: function(){
            this.isOpenRemplazo = false;
            this.$page.props.errors = [];
        },
        closeModalPass: function () {
            this.isOpencambiopass = false
            this.$page.props.errors.updatePassword = null;
        },
        subirArchivo: function (data) {
            this.$inertia.post('/archivo/upload', data, {
                onSuccess: (page) => {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Archivo actualizado',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.actualizarArchivos(data.idmilitante);
                },
            });
        },
        actualizarArchivos: function (data) {
            var url= '/getArchivos';
            axios.get(url, {
                params: {
                    idmilitante: data
                }
            }).then((res) => {
                console.log(res);
                this.arrayArchivos = res.data.archivos;
            })
        },
        getHistorial: function (data) {
            var url= '/militantes/getHistorial';
            axios.get(url, {
                params: {
                    idmilitante: data
                }
            }).then((res) => {
                this.arrayHistorial = res.data.historial;
            })
        },
        verHistorial: function (data) {
            this.verHistorialobs = data;
            this.isOpenverHistorial = true;
        },
        updateEstado: function (data) {
            var url= '/militantes/updateEstado/' + data.idmilitante;
            axios.get(url, {
                params: {
                    idmilitante: data.idmilitante,
                    tipo: data.tipo,
                    estado: data.estado,
                    observaciones: data.observaciones,
                }
            }).then((res) => {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'El proceso se realizó correctamente',
                    showConfirmButton: false,
                    timer: 2500
                })
                this.closeModal();
                this.isOpenCambioestado = false;
                this.getmilitantes('','updated_at');
                this.formestado = [];
            })
        },
        ccsolicitar: function (data) {
            var url= '/militantes/ccupdate/' + data.id;
            axios.get(url, {
                params: {
                    idmilitante: data.id,
                    tipo: 'solicitar',
                    cccreated_at: this.dateTimeFull(data.cccreated_at),
                    ccobservaciones: data.ccobservaciones,
                }
            }).then((res) => {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'El proceso se realizó correctamente',
                    showConfirmButton: false,
                    timer: 2500
                })
                this.closeModal();
                this.isOpenCambioestado = false;
                this.getmilitantes('','updated_at');
                this.formestado = [];
            })
        },
        ccreposicion: function (data) {
            var url= '/militantes/ccupdate/' + data.id;
            axios.get(url, {
                params: {
                    idmilitante: data.id,
                    tipo: 'reposicion',
                    ccreposicion: data.ccreposicion,
                    ccupdated_at: this.dateTimeFull(data.ccupdated_at),
                    ccobservaciones: data.ccobservaciones,
                }
            }).then((res) => {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'El proceso se realizó correctamente',
                    showConfirmButton: false,
                    timer: 2500
                })
                this.closeModal();
                this.isOpenCambioestado = false;
                this.getmilitantes('','updated_at');
                this.formestado = [];
            })
        },
        cambiarEstado: function (id, tipo) {
            this.formestado.idmilitante = id;
            this.formestado.tipo = tipo;
            this.isOpenCambioestado = true;
        },
        registroHistorial: function (id, tipo, observaciones) {
            var url= '/militantes/registroHistorial';
            axios.get(url, {
                params: {
                    id: id,
                    tipo: tipo,
                    observaciones: observaciones,
                }
            }).then((res) => {
                Swal.fire({
                    position: 'top-end',
                    icon: 'success',
                    title: 'El proceso se realizó correctamente',
                    showConfirmButton: false,
                    timer: 2500
                })
                this.closeModal();
                this.getmilitantes('','updated_at');
                this.formestado = [];
            })
        },
        descargarArchivo: function (data) {
            window.open(data, '_blank');
        },
        reset: function () {
            this.activetab = '1';
            this.tituloModalDetalle = '';
            this.form.id = null;
            this.tituloModal = '';
            this.form.fechaingreso = null;
            this.form.idpais = 1;
            this.form.iddepartamento = '-';
            this.form.idciudad = '-';
            this.form.idtipos_documento = '-';
            this.form.nombre = null;
            this.form.apellido = null;
            this.form.correo = null;
            this.form.movil = null;
            this.form.documento = null;
            this.form.direccion = null;
            this.form.telefono = null;
            this.form.observaciones = null;
            this.form.idgenero = '-';
            this.form.idinscripcion = '-';
            this.form.idniveleducativo = '-';
            this.form.idgrupoetnico = '-';
            this.form.discapacitado = 0;
            this.form.victimaconflicto = 0;
            this.form.lider = 0;
            this.form.avalado = 0;
            this.form.idcorporacion = null;
            this.form.periodo = 0;
            this.form.electo = 0;
            this.form.votos = 0;
            this.form.estado = 0;
            this.form.coalicion = 0;
            this.form.nombrecoalicion = null;
            this.form.renuncio = 0;
            this.form.fecharenuncia = null;
            this.form.idremplazo = null;
            this.form.fechainicio = null;
            this.form.fechafin = null;
            this.form.ccestado = null;
            this.form.ccreposicion = null;
            this.form.ccobservaciones = null;
            this.form.cccreated_at = null;
            this.form.ccupdated_at = null;
        },
        save: function (data) {
            data.fechaingreso = this.dateTimeFull(data.fechaingreso);
            data.fechanacimiento = data.fechanacimiento?this.dateTimeFull(data.fechanacimiento):null;
            data.fecharenuncia = data.fecharenuncia?this.dateTimeFull(data.fecharenuncia):null;
            this.$inertia.post('/militantes', data, {
                onSuccess: (page) => {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'El militante ha sido creado',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.reset();
                    this.closeModal();
                    this.getmilitantes('','updated_at');
                    this.editMode = false;
                },
            });

        },
        edit: function (data) {
            this.editMode = true;
            this.newMode = false;
            this.verMode = false;
            this.arrayArchivos = data.archivos;
            this.archivoform.idmilitante =  data['id'];
            this.openModal('actualizar', data);
        },
        ver: function (data) {
            this.verMode = true;
            this.editMode = false;
            this.newMode = false;
            this.arrayArchivos = data.archivos;
            this.archivoform.idmilitante =  data['id'];
            this.openModal('ver', data);
        },
        update: function (data) {
            data.fechaingreso = this.dateTimeFull(data.fechaingreso);
            data.fechanacimiento = data.fechanacimiento?this.dateTimeFull(data.fechanacimiento):null;
            data.fecharenuncia = data.fecharenuncia?this.dateTimeFull(data.fecharenuncia):null;
            data._method = 'PUT';
            this.$inertia.post('/militantes/'  + data.id, data, {
                onSuccess: (page) => {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'El militante se ha actualizado!',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    this.getmilitantes('','updated_at');
                    this.closeModal();
                    this.reset();
                    this.editMode = false;
                    this.verMode = false;
                    this.newMode = false;
                },
            });
        },
        getmilitantes: function (buscar, sortBy, filtros = []) {
            this.buscar = buscar;

            if (sortBy == this.sortBy){
                this.sortOrder = !this.sortOrder;
            }
            let sortOrderdesc;
            if (this.sortOrder){
                sortOrderdesc = 'desc';
            } else {
                sortOrderdesc = 'desc';
            }
            this.sortBy = sortBy;
            this.ispage = true;

            var url= '/militantes';
            axios.get(url, {
                params: {
                    filtros: filtros,
                    buscar: this.buscar,
                    sortBy: this.sortBy,
                    sortOrder: sortOrderdesc,
                    ispage: this.ispage
                }
            }).then((res) => {
                var respuesta = res.data;
                this.arrayData = respuesta.militantes;
            })
        },
        militantesExport: function (filtros = []) {
            let fecha = moment(new Date()).format('DDMMYYYY');
            var url= '/militantes/export';
            axios.get(url, {
                params: {
                    filtros: filtros,
                },
                responseType: 'blob',
            }).then((response) => {
                console.log(response.data);
                var fileURL = window.URL.createObjectURL(new Blob([response.data]));
                var fileLink = document.createElement('a');

                fileLink.href = fileURL;
                fileLink.setAttribute('download', 'militantes_'+ fecha + '.xlsx');
                document.body.appendChild(fileLink);

                fileLink.click();
            })
        },
        deleteRow: function (data) {
            let mensaje = '';
            let title = '';
            let html = '';
            if (data.estado) {
                mensaje = 'Desea desactivar el usuario?';
                title = 'Desactivado!';
                html = 'El usuario ha sido desactivado con éxito';
            } else {
                mensaje = 'Desea activar el usuario?';
                title = 'Activado!';
                html = 'El usuario ha sido activado con éxito.';
            }
            Swal.fire({
                title: mensaje,
                text: "Solo un administrador podrá revertir esta acción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, Proceder!'
            }).then((result) => {
                data._method = 'DELETE';
                axios.post('/militantes/' + data.id, data)
                    .then((res) => {
                        this.getmilitantes('','nombre');
                        Swal.fire(
                            title,
                            html,
                            'success'
                        )
                    }).catch(function (error) {
                    //(error);
                });
            })

        },
    },
    created: function () {
        this.arrayData = this.militantes;
        this.getInscripciones();
        this.getGeneros();
        this.getNiveleducativo();
        this.getGruposetnicos();
        this.getCorporaciones();
        this.getTiposarchivos();
        this.getEstados();
        this.getTipohistorial();
    },
    mounted() {
        console.log(this.militantes);
    },
}
</script>
