<template>
    <app-layout title="新增簽呈">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                新增簽呈
                <a class="float-right" :href="route('implementation_matter.create')">
                    <jet-button>新增</jet-button>
                </a>
            </h2>
      </template>
    <form id="fundform" @submit.prevent="createrequisition()">
        <div class="py-12">
            <div class="max-w-7xl mx-auto base:text-center px-6 lg:px-8">
              <div class="mt-10 sm:mt-0">
                <div class="md:grid md:gap-6">
                  <div class="mt-5 md:mt-0 ">
                      <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                          <div class="grid grid-cols-6 gap-6">
                            <jet-validation-errors class="mb-4" />
                            <div class="col-span-6">
                              <jet-label for="letter_num" class="block text-base font-medium text-gray-700">簽呈編號<a class="text-red-500">*</a> </jet-label>
                              <input type="text" v-model="form.letter_num" name="letter_num" id="letter_num" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base border-gray-300 rounded-md" required>
                            </div>

                            <div class="col-span-6">
                              <jet-label for="implementation_matter" class="block text-base font-medium text-gray-700">主旨<a class="text-red-500">*</a> </jet-label>
                              <input type="text" v-model="form.implementation_matter" name="implementation_matter" id="implementation_matter" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base border-gray-300 rounded-md">
                            </div>

                            <div class="col-span-6">
                              <jet-label for="supplement" class="block text-base font-medium text-gray-700">補充說明</jet-label>
                              <input type="text" v-model="form.supplement" name="supplement" id="supplement" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base border-gray-300 rounded-md">
                            </div>
                            <div class="col-span-6 sm:col-span-6">
                                  <!-- <Listbox as="div" v-model="selected">
                                    <ListboxLabel class="block text-sm font-medium text-gray-700">
                                    申請處室
                                    </ListboxLabel>
                                    <div class="mt-1 relative">
                                      <ListboxButton class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"  v-model="form.academy">
                                          <span class="ml-3 block truncate" v-if="selected.academy">{{ selected.academy }}</span>
                                          <span class="ml-3 block truncate" v-else>選擇學院</span>
                                        <span class="ml-3 absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                          <SelectorIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                                        </span>
                                      </ListboxButton>

                                      <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">
                                        <ListboxOptions class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-56 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm">
                                          <ListboxOption as="template" v-for="academy in academys" :key="academy.dep_id" :value="academy" v-slot="{ active, selected }">
                                            <li :class="[active ? 'text-white bg-indigo-600' : 'text-gray-900', 'cursor-default select-none relative py-2 pl-3 pr-9']">
                                              <div class="flex items-center">
                                                <span :class="[selected ? 'font-semibold' : 'font-normal', 'ml-3 block truncate']">
                                                  {{ academy.academy }}
                                                </span>
                                              </div>

                                              <span v-if="selected" :class="[active ? 'text-white' : 'text-indigo-600', 'absolute inset-y-0 right-0 flex items-center pr-4']">
                                                <CheckIcon class="h-5 w-5" aria-hidden="true" />
                                              </span>
                                            </li>
                                          </ListboxOption>
                                        </ListboxOptions>
                                      </transition>
                                    </div>
                                  </Listbox> -->
                                  <Listbox as="div" v-model="selected_dep">
                                    <ListboxLabel class="block text-sm font-medium text-gray-700">
                                    使用處室<a class="text-red-500">*</a> 
                                    </ListboxLabel>
                                    <div class="mt-1 relative">
                                      <ListboxButton class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" v-model="form.department">
                                          <!-- <img :src="selected.avatar" alt="" class="flex-shrink-0 h-6 w-6 rounded-full" /> -->
                                          <span class="ml-3 block truncate" v-if="selected_dep.department">{{ selected_dep.department }}</span>
                                          <span class="ml-3 block truncate" v-else>選擇處室</span>
                                        <span class="ml-3 absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                          <SelectorIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                                        </span>
                                      </ListboxButton>

                                      <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">
                                        <ListboxOptions class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-56 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm">
                                          <ListboxOption as="template" v-for="dep in deps" :key="dep.dep_id" :value="dep" v-slot="{ active, selected_dep}">
                                            <li :class="[active ? 'text-white bg-indigo-600' : 'text-gray-900', 'cursor-default select-none relative py-2 pl-3 pr-9']">
                                              <div class="flex items-center">
                                                <span :class="[selected_dep ? 'font-semibold' : 'font-normal', 'ml-3 block truncate']">
                                                  {{ dep.department }}
                                                </span>
                                              </div>

                                              <span v-if="selected_dep" :class="[active ? 'text-white' : 'text-indigo-600', 'absolute inset-y-0 right-0 flex items-center pr-4']">
                                                <CheckIcon class="h-5 w-5" aria-hidden="true" />
                                              </span>
                                            </li>
                                          </ListboxOption>
                                        </ListboxOptions>
                                      </transition>
                                    </div>
                                  </Listbox>
                            </div>
                            <div class="col-span-3">
                              <jet-label for="applicant" class="block text-base font-medium text-gray-700">申請人<a class="text-red-500">*</a> </jet-label>
                              <input type="text" v-model="form.applicant" name="applicant" id="applicant" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base border-gray-300 rounded-md">
                            </div>

                            <div class="col-span-3">
                              <jet-label for="director" class="block text-base font-medium text-gray-700">主管</jet-label>
                              <input type="text" v-model="form.director" name="director" id="director" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base border-gray-300 rounded-md">
                            </div>

                            <!-- <div class="col-span-3 sm:col-span-3 lg:col-span-2">
                              <jet-label for="indicator" class="block text-base font-medium text-gray-700">項目</jet-label>
                              <input type="text" v-model="form.indicator" name="indicator" id="indicator" autocomplete="indicator" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base border-gray-300 rounded-md">
                            </div> -->

                            <div class="col-span-3 sm:col-span-3 lg:col-span-3">
                              <jet-label for="amount" class="block text-base font-medium text-gray-700">金額<a class="text-red-500">*</a> </jet-label>
                              <input type="text" v-model="form.amount" name="amount" id="amount" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-base border-gray-300 rounded-md">
                                <div class="py-6">
                                  <button type="button" v-on:click="sub_modalon()" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                      選擇分項
                                  </button>
                                  {{ form.sub_name }}
                                </div>
                                <div class="py-6">
                                  <button type="button" v-on:click="fund_modalon()" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                      選擇經費
                                  </button>
                                    {{ form.fund_name_id }}
                                </div>
                            </div>

                          <div class="col-span-6 sm:col-span-3">
                            <jet-label for="remark" class="block text-base font-medium text-gray-700">
                              備註
                            </jet-label>
                            <div class="mt-1">
                              <textarea id="remark" v-model="form.remark" name="remark" rows="7" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full text-base border border-gray-300 rounded-md resize-y" placeholder="備註"></textarea>
                            </div>
                          </div>

                        <div class="col-span-6">
                          <div id="ermsg" for="ermsg" class="hidden text-xl font-medium text-red-600 text-right font-black"></div>
                          <a class="float-right">
                          <jet-button type="button" @click="addfund()" class=" right-0 text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            新增經費
                          </jet-button>
                          </a>
                        </div>
                        <div class="col-span-6" aria-hidden="true">
                            <div class="border-t border-gray-200" />
                        </div>
                        <!-- 經費列表 -->
                        <div class="col-span-6">
                            <table class="min-w-full divide-y divide-gray-200" >
                              <thead class="bg-gray-50">
                                <tr>
                                  <th scope="col" class="text-center px-6 py-3 text-left text-base font-medium text-gray-500 uppercase tracking-wider">
                                    分項
                                  </th>
                                  <th scope="col" class="text-center px-6 py-3 text-left text-base font-medium text-gray-500 uppercase tracking-wider">
                                    經費來源
                                  </th>
                                  <th scope="col" class="text-center px-6 py-3 text-left text-base font-medium text-gray-500 uppercase tracking-wider">
                                    金額
                                  </th>
                                  <th scope="col" class="text-center px-6 py-3 text-left text-base font-medium text-gray-500 uppercase tracking-wider">
                                    備註
                                  </th>
                                </tr>
                              </thead>
                              <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="(ll,index) in fund_list" :key="ll.fund_id">
                                  <td class="text-center px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-base text-gray-900">
                                    {{ll.sub_name}}
                                    </div>
                                  </td>
                                  <td class="text-center px-6 py-4 whitespace-nowrap">
                                    <div class="text-base text-gray-900" v-html="handleNewLine(ll.fund_name_id,25)">
                                    </div>
                                  </td>
                                  <td class="text-center px-6 py-4 whitespace-nowrap text-base text-gray-500">
                                    <div class="text-base text-gray-900">
                                      {{ll.amount}}
                                    </div>
                                  </td>
                                  <td class="text-left px-6 py-4 whitespace-nowrap text-base text-gray-500">
                                    <div class="text-base text-gray-900" v-html="tobr(ll.remark)">
                                    </div>
                                  </td>
                                  <td class="text-center px-6 py-4 whitespace-nowrap text-center">
                                    <div class="text-base text-gray-900">
                                      <button type="button" @click="del_fund_list(index)" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                      </svg>
                                      </button>
                                    </div>
                                  </td>
                                </tr>
                              </tbody>
                            </table>
                        </div>
                        <!-- <div class="col-span-6 sm:col-span-6">
                            <label class="block text-base font-medium text-gray-700">
                              檔案上傳
                            </label>
                              <form action="{{ route('dropzone.upload') }}" class="dropzone mt-1  px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md" id="my-great-dropzone" >
                                <input type="hidden" name="_token" v-bind:value="csrf">
                                <div class="dz-message">
                                <div class="space-y-1 text-center">
                                  
                                  <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                    <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                  </svg>
                                  <div class=" text-sm text-gray-600">
                                    <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                      <span>Upload a file</span>
                                      <input id="file-upload" name="file-upload" type="file" class="sr-only" multiple />
                                    </label>
                                    <p class="pl-1">or drag and drop</p>
                                  </div>
                                  <p class="text-xs text-gray-500">
                                    PDF, PNG, JPG, GIF up to 10MB
                                  </p>
                                </div> 
                                </div>
                              </form>
                            </div> -->
                          </div>
                        </div>
                        <div class="px-4 py-3 bg-gray-50 text-right sm:text-center px-6">
                          <jet-button type="" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            儲存
                          </jet-button>
                        </div>

                      </div>
                  </div>
                </div>
              </div>
            </div>
        </div>
        </form>
        <!-- 經費 -->
        <div class="fixed hidden inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full" id="fund_modal">
          <div class="pt-24">
            <div class="py-2 align-middle inline-block min-w-full sm:text-center px-6 lg:px-8">
              <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                <div class="px-6 pr-0 relative ">
                  <div class="right-0 absolute ">
                    <div onclick="document.getElementById('fund_modal').classList.add('hidden')" class="px-6 mt-3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 close-btn" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                    </div>
                  </div>
                </div>
                <table class="min-w-full divide-y divide-gray-200" >
                  <thead class="bg-gray-50">
                    <tr>
                      <th scope="col" class="text-center px-6 py-3 text-left text-base font-medium text-gray-500 uppercase tracking-wider">
                        計畫名稱/項目
                      </th>
                      <th scope="col" class="text-center px-6 py-3 text-left text-base font-medium text-gray-500 uppercase tracking-wider">
                        經費名稱
                      </th>
                      <th scope="col" class="text-center px-6 py-3 text-left text-base font-medium text-gray-500 uppercase tracking-wider">
                        已核銷/總額
                      </th>
                      <th scope="col" class="text-center px-6 py-3 text-left text-base font-medium text-gray-500 uppercase tracking-wider">
                        選擇
                      </th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="fund in funds" :key="fund.fund_id">
                      <td class="text-center px-6 py-4 whitespace-nowrap">
                        <div class="flex items-center justify-center">
                          <div class="ml-4">
                            <div class="text-base font-medium text-gray-900">
                              {{fund.plan_name}}
                            </div>
                            <div class="text-left text-sm text-gray-500">
                              {{fund.assets_item}}
                            </div>
                          </div>
                        </div>
                      </td>
                      <td class="text-center px-6 py-4 whitespace-nowrap">
                        <div class="text-base text-gray-900">
                              {{fund.fund_name}}</div>
                      </td>
                      <td class="text-center px-6 py-4 whitespace-nowrap text-center">
                        {{fund.reimburse}} / {{fund.amount}}
                      </td>
                      <td class="text-center px-6 py-4 whitespace-nowrap text-base text-gray-500">
                        <button type="button" v-on:click="select_fund(fund.fund_id)" :value="fund.fund_id" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                          選擇
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- 分項 -->
        <div class="fixed hidden inset-0 bg-gray-600 bg-opacity-50 overflow-hidden w-full h-screen" id="sub_modal">
          <div class="pt-24">
            <div class="py-2 align-middle inline-block min-w-full sm:text-center px-6 lg:px-8">
              <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg overflow-y-auto w-full h-screen-80">
                <div class="px-6 pr-0 relative">
                  <div class="right-0 absolute">
                    <div onclick="document.getElementById('sub_modal').classList.add('hidden')" class="px-6 mt-3">
                      <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 close-btn" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                      </svg>
                    </div>
                  </div>
                </div>
                <table class="min-w-full divide-y divide-gray-200">
                  <thead class="bg-gray-50">
                    <tr>
                      <th scope="col" class="text-center px-6 py-3 text-base font-medium text-gray-500 uppercase tracking-wider">
                        分項
                      </th>
                      <th scope="col" class="px-6 py-3 text-center text-base font-medium text-gray-500 uppercase tracking-wider">
                        分項執行方案重點
                      </th>
                      <th scope="col" class="text-left px-6 py-3 text-base font-medium text-gray-500 uppercase tracking-wider">
                        部定共同/自訂績效指標項目
                      </th>
                      <th scope="col" class="text-left px-6 py-3 text-base font-medium text-gray-500 uppercase tracking-wider">
                        選擇
                      </th>
                    </tr>
                  </thead>
                  <tbody class="bg-white divide-y divide-gray-200">
                    <tr v-for="sub_strategy in sub_strategys" :key="sub_strategy.sub_id">
                      <td class="text-left px-6 py-4 whitespace-nowrap">
                        <div class="flex items-left justify-center">
                          <div class="ml-4" v-if="sub_strategy.sub_num != 0">
                            {{ sub_strategy.sub_item_id }} - {{ sub_strategy.sub_num }}
                          </div>
                          <div class="ml-4" v-if="sub_strategy.sub_num == 0">
                            {{ sub_strategy.sub_item_id }}
                          </div>
                        </div>
                      </td>
                      <td class="text-left px-6 py-4 w-11 whitespace-nowrap break-all">
                          <div class="text-left text-base text-gray-900" v-html="handleNewLine(sub_strategy.emphasis,25)">
                          </div>
                      </td>
                      <td class="text-left px-6 py-4 whitespace-nowrap text-left">
                          <div class="text-left text-base text-gray-900" v-html="handleNewLine(sub_strategy.target,15)">
                          </div>
                      </td>
                      <td class="text-left px-6 py-4 whitespace-nowrap text-base text-gray-500">
                        <button type="button" v-on:click="select_sub(sub_strategy.sub_id)" :value="sub_strategy.sub_id" class="inline-flex items-left px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                          選擇
                        </button>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
    </app-layout>
</template>

<script>
import { defineComponent } from 'vue'
import JetButton from '@/Jetstream/Button.vue'
import JetFormSection from '@/Jetstream/FormSection.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetInputError from '@/Jetstream/InputError.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetActionMessage from '@/Jetstream/ActionMessage.vue'
import AppLayout from '@/Layouts/AppLayout.vue'
import JetSecondaryButton from '@/Jetstream/SecondaryButton.vue'
import { Inertia } from '@inertiajs/inertia'
import { ref } from 'vue'
import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue'
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
import { CheckIcon, SelectorIcon } from '@heroicons/vue/solid'
import Dropzone from 'dropzone';
import 'dropzone/dist/dropzone.css';
export default defineComponent({
        components: {
            AppLayout,
            JetActionMessage,
            JetButton,
            Dropzone,
            JetFormSection,
            JetInput,
            JetInputError,
            JetLabel,
            JetSecondaryButton,
            Inertia,
            Listbox,
            ListboxButton,
            ListboxLabel,
            ListboxOption,
            ListboxOptions,
            CheckIcon,
            JetValidationErrors,
            SelectorIcon,
        },
        setup() {

        },
        data(){
          return{
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            form:this.$inertia.form({
              'letter_num': '',
              'implementation_matter': '',
              'supplement': '',
              'dep_id': '',
              'applicant': '',
              'director': '',
              'fund_lists': '',
              'remark': '',
              'fund_id': '',
              'sub_id': '',
              'amount': '',
            }),
            fund_list:[]
          }
        },
        props:['funds','sub_strategys','deps'],
        
        mounted() {
          if (document.getElementById('my-great-dropzone')) {
            Dropzone.options.myGreatDropzone = {
              url: route('dropzone.upload'),
              uploadMultiple: false,
              autoProcessQueue: true,
              init: function fileupload(){
                this.processQueue();
              },
               success:function(file, response)
              {
                  console.log(response)
                  return file.previewElement.classList.add("dz-success");
              },
              // accept: function(file, done) {
              //   if (file.name == "justinbieber.jpg") {
              //     done("Naha, you don't.");
              //   }
              //   else { done(); }
              // }
            };
          }
        },
        created() {
          window.onclick = function(event) {
              let f =document.getElementById('fund_modal')
              let s =document.getElementById('sub_modal')

              if (event.target ==  f | event.target ==  f.children[0] | event.target ==  f.children[0].children[0] ) {
                  document.getElementById('fund_modal').classList.add("hidden")
              }
              if (event.target ==  s | event.target ==  s.children[0] | event.target ==  s.children[0].children[0] ) {
                  document.getElementById('sub_modal').classList.add("hidden")
              }
          }
          const set = new Set();
          this.academys = this.deps.filter(item => !set.has(item.academy) ? set.add(item.academy) : false);
          this.selected = ref(this.deps[3])
          this.selected_dep = ref(this.deps[3])

          let last = [this.funds[0].plan_name,this.funds[0].assets_item];
          this.res=[];
          let data = [];
          this.funds.forEach((element,index) => {
              if (element.plan_name == last[0] && element.assets_item == last[1]){
                  data.push(element)
              }
              else{
                  this.res.push({
                      'planname': last[0],
                      'assets_item': last[1],
                      'data': data,
                  })
                  data=[]
                  data.push(element)
              }
              last = [element.plan_name,element.assets_item];
              if (index == this.funds.length-1){
                  this.res.push({
                      'planname': last[0],
                      'assets_item': last[1],
                      'data': data,
                  })
              }
          });
        },
        methods: {
            del_fund_list(list_id){
              this.fund_list.splice(list_id,1)
            },
            tobr(text){
              if (text != undefined)
                return text.replace(/\n/g,'<br>')
            },
            addfund(){
              this.check = [{
                  'status': this.form.fund_id===''
                },{
                  'status': this.form.sub_id === ''
                },{
                  'status': this.form.amount === ''
                },
              ]
              if (this.check[0]['status'] || this.check[1]['status'] || this.check[2]['status']){
                let ermsg=''
                if(this.check[2]['status']){ermsg= ermsg + '金額 '}
                if(this.check[0]['status']){ermsg= ermsg + '經費 '}
                if(this.check[1]['status']){ermsg= ermsg + '分項計畫 '}
                ermsg= ermsg + '未選擇';
                document.getElementById('ermsg').innerText = ermsg
                document.getElementById('ermsg').classList.remove('hidden')
              }
              else{
                this.fund_list.push({
                  // 'indicator': this.form.indicator,
                  'fund_id': this.form.fund_id,
                  'fund_name_id': this.form.fund_name_id,
                  'sub_id': this.form.sub_id,
                  'sub_name': this.form.sub_name,
                  'amount': this.form.amount,
                  'remark': this.form.remark,
                })

                this.form.indicator = '';
                this.form.remark = '';
                this.form.amount = '';
                this.form.fund_id = '';
                this.form.fund_name_id='';
                this.form.sub_id = '';
                this.form.sub_name = '';
                document.getElementById('ermsg').classList.add('hidden')
                }
            },
            handleNewLine(str,num) {
              if (num===15){
                return str.replace(/.{15}\x01?/g,"$&</br>");
              }
              else if (num===25){
                return str.replace(/.{25}\x01?/g,"$&</br>");
              }
              else
                return str.replace(/.{35}\x01?/g,"$&</br>");
            },
          fund_modalon(){document.getElementById('fund_modal').classList.remove('hidden')},
          sub_modalon(){document.getElementById('sub_modal').classList.remove('hidden')},
          select_fund(a){
            let tmp = this.funds.find(item =>item.fund_id === a)
            this.form.fund_id = a
            this.form.fund_name_id = tmp['plan_name'] +'-'+ tmp['assets_item'] +'-' + tmp['fund_name']
            document.getElementById('fund_modal').classList.add("hidden")
          },
          select_sub(s){
            let tmp = this.sub_strategys.find(item =>item.sub_id === s)
            this.form.sub_id = s
            tmp['target'] ? (this.form.sub_name = tmp['sub_item_id'] +'-'+ tmp['sub_num'] +'-' + tmp['target']) : (this.form.sub_name = tmp['sub_item_id'] +'-'+ tmp['sub_num'])
            document.getElementById('sub_modal').classList.add("hidden")
          },
          createrequisition() {
            this.form.dep_id = this.selected_dep.dep_id;
            this.form.fund_lists = JSON.stringify(this.fund_list);
            this.form.post(this.route('implementation_matter.store'))
          },
        },
    })
</script>
