<template>
    <AppLayout title="Auditoria">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Auditoria Militantes
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
                                    Auditoria
                                </h1>
                            </div>

                        </div>
                    </section>
                    <!-- Fin Encabezado y titulo Busqueda -->
                    <section>
                        <div class="px-4">
                            <form @submit.prevent="getauditoria('', '', formbusqueda)" @keyup.enter="getauditoria('', '', formbusqueda)">
                                <div class="grid xl:grid-cols-3 xl:gap-6">
                                    <div class="relative z-0 w-full mb-4 group">
                                        <Datepicker v-model="formbusqueda.fechainicio" :enableTimePicker="false" autoApply placeholder="Fecha inicio" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"/>
                                    </div>
                                    <div class="relative z-0 w-full mb-4 group">
                                        <Datepicker v-model="formbusqueda.fechafin" :enableTimePicker="false" autoApply placeholder="Fecha fin" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer"/>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="formbusqueda.usuario" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Usuario
                                        </label>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <select class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" v-model="formbusqueda.evento">
                                            <option value="-" >Seleccione</option>
                                            <option value="created" >Creado</option>
                                            <option value="updated" >Modificado</option>
                                            <option value="deleted" >Eliminado</option>
                                            <option value="restored" >Restaurado</option>
                                        </select>
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Evento
                                        </label>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="formbusqueda.militante" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            Militante
                                        </label>
                                    </div>
                                    <div class="relative z-0 w-full mb-6 group">
                                        <input type="text" v-model="formbusqueda.ip" class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none focus:outline-none focus:ring-0 focus:border-blue-600 peer" placeholder=" "  />
                                        <label class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:left-0 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                                            IP
                                        </label>
                                    </div>
                                </div>
                                <div class="flex mx-auto">
                                    <button type="button" @click="getauditoria('', '', formbusqueda)" class="mx-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buscar</button>
                                    <a  href="#" @click="auditoriaExport(formbusqueda)">
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
                                            Fecha
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
                                            Usuario
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
                                            Evento
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
                                        <button @click="getmilitantes(buscar, 'nombre')" class="font-bold">
                                            Militante
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
                                        <button @click="getmilitantes(buscar, 'documento')" class="font-bold">
                                            Datos viejos
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
                                    <th class="px-4 py-2 text-sm w-2/12 font-bold hover:bg-blue-500 hover:text-gray-50 rounded-b">
                                        <button @click="getmilitantes(buscar, 'movil')" class="font-bold">
                                            Datos Nuevos
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
                                </tr>
                                </thead>
                                <tbody>
                                <tr :class="user.id === selectedRow ? 'bg-blue-200' : ''"  class="text-center hover:bg-blue-400" @click="rowSelect(user.id)" text-sm v-if="arrayData.data" v-for="(user, id) in arrayData.data" :key="id">
                                    <td class="border px-1 py-2 text-sm truncate" v-text="dateTimeFull(user.updated_at)"></td>
                                    <td class="border px-1 py-2 text-sm truncate" v-text="user.nombreusuario + ' ' + user.apellidousuario"></td>
                                    <td class="border px-1 py-2 text-sm truncate" v-text="user.event"></td>
                                    <td class="border px-1 py-2 text-sm truncate" v-text="user.nombremilitante + ' ' + user.apellidomilitante"></td>
                                    <td class="border px-1 py-2 text-sm">
                                        <table class="table text-left">
                                            <tr v-if="user.old_values" v-for="(value, attribute, id) in user.old_values" :key="id">
                                                <td>{{ attribute }}: </td>
                                                <td>{{ value }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td class="border px-1 py-2 text-sm">
                                        <table class="table text-left">
                                            <tr v-if="user.new_values" v-for="(value, attribute, id) in user.new_values" :key="id">
                                                <td>{{ attribute }}: </td>
                                                <td>{{ value }}</td>
                                            </tr>
                                        </table>
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
                                                     v-on:click="this.cambiarPage(link.url, 'auditoria', formbusqueda)"
                                                     v-html="link.label" />
                                        </template>
                                    </div>
                                </div>
                            </section>
                            <!-- Paginacion -->
                        </div>
                    </section>
                    <!-- Fin Tabla de contenido -->



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
        auditorias : [],
        errors: Object
    },
    computed: {

    },
    data() {
        return {
            activetab: '1',
            tituloModal: '',
            tituloModalDetalle: '',
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
                estados: []
            },
            formbusqueda: {
                id: null,
                usuario: '-',
                evento: '-',
                militante: '-',
                fechainicio: null,
                fechafin: null
            },
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
        cambiarEstado: function (id, tipo) {
            this.formestado.idmilitante = id;
            this.formestado.tipo = tipo;
            this.isOpenCambioestado = true;
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
        },
        save: function (data) {
            data.fechaingreso = this.dateTimeFull(data.fechaingreso);
            data.fechanacimiento = this.dateTimeFull(data.fechanacimiento);
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
            data.fechanacimiento = this.dateTimeFull(data.fechanacimiento);
            data.fecharenuncia = data.fecharenuncia?this.dateTimeFull(data.fecharenuncia):null;
            data._method = 'PUT';
            this.$inertia.post('/militantes/'  + data.id, data, {
                onSuccess: (page) => {
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'El  se ha militanteactualizado!',
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
        getauditoria: function (buscar, sortBy, filtros = []) {
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

            var url= '/militantes/indexAuditoria';
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
                this.arrayData = respuesta.auditorias;
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
        this.arrayData = this.auditorias;

        //var obj = {"hello":"world", "Test":["hello"]}
        //console.log(document.createTextNode(JSON.stringify(obj, null, 4)));
    },
    mounted() {
    },
}
</script>
