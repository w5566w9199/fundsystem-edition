<template>
    <app-layout title="新增計畫">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                新增計畫
                <a class="float-right" :href="route('fund_table.create')" :active="route().current('fund_table.*')">
                    <jet-button>新增</jet-button>
                </a>
            </h2>
      </template>


    <form id="fundform" @submit.prevent="createrequisition()">
        <div class="py-12">
            <div class="max-w-7xl mx-auto base:px-6 lg:px-8">
              <div class="mt-10 sm:mt-0">
                <div class="md:grid md:gap-6">
                  <div class="mt-5 md:mt-0 ">
                      <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                          <div class="grid grid-cols-12 gap-6">
                            <div class="col-span-12">
                              <jet-validation-errors class="mb-4" />
                              <jet-label for="plan_name" class="block text-sm font-medium text-gray-700">計畫名稱<a class="text-red-500">*</a> </jet-label>
                              <input type="text" v-model="form.plan_name" name="plan_name" id="plan_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                            </div>

                            <div class="col-span-6 sm:col-span-12">
                              <jet-label for="asset_item" class="block text-sm font-medium text-gray-700">項目<a class="text-red-500">*</a> </jet-label>
                              <input type="text" v-model="form.asset_item" name="asset_item" id="asset_item" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                              <jet-label for="fund_name_1" class="block text-sm font-medium text-gray-700">人事費<a class="text-red-500">*</a> </jet-label>
                              <input type="number" v-model="form.fund_name_1" name="fund_name_1" id="fund_name_1" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                              <jet-label for="fund_name_2" class="block text-sm font-medium text-gray-700">業務費<a class="text-red-500">*</a> </jet-label>
                              <input type="number" v-model="form.fund_name_2" name="fund_name_2" id="fund_name_2" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                              <jet-label for="fund_name_3" class="block text-sm font-medium text-gray-700">補助款資本門<a class="text-red-500">*</a> </jet-label>
                              <input type="number" v-model="form.fund_name_3" name="fund_name_3" id="fund_name_3" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                              <jet-label for="fund_name_4" class="block text-sm font-medium text-gray-700">配合款<a class="text-red-500">*</a> </jet-label>
                              <input type="number" v-model="form.fund_name_4" name="fund_name_4" id="fund_name_4" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                            </div>

                            <div class="col-span-6">
                              <jet-label for="start_date" class="block text-sm font-medium text-gray-700">開始日期<a class="text-red-500">*</a> </jet-label>
                              <datepicker v-model="form.start_date" placeholder="開始日期" name="start_date" id="start_date" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" type="date" :typeable="true" />
                            </div>

                            <div class="col-span-6">
                              <jet-label for="end_date" class="block text-sm font-medium text-gray-700">結束日期<a class="text-red-500">*</a> </jet-label>
                              <datepicker v-model="form.end_date" placeholder="結束日期" name="end_date" id="end_date" :format="formatDate" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" type="date" :typeable="true" />
                            </div>
                          <div class="col-span-6 sm:col-span-12">
                            <jet-label for="remark" class="block text-base font-medium text-gray-700">
                              備註
                            </jet-label>
                            <div class="mt-1">
                              <textarea id="remark" v-model="form.remark" name="remark" rows="10" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full text-base border border-gray-300 rounded-md resize-y" placeholder="備註"></textarea>
                            </div>
                          </div>

                        <!-- <div class="col-span-6 sm:col-span-12">
                            <label class="block text-sm font-medium text-gray-700">
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
                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                          <jet-button type="" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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
import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue'
import { CheckIcon, SelectorIcon } from '@heroicons/vue/solid'
import Datepicker from 'vue3-datepicker'
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
import Dropzone from 'dropzone';
import 'dropzone/dist/dropzone.css';

export default defineComponent({
        components: {
            AppLayout,
            JetActionMessage,
            JetButton,
            JetFormSection,
            JetInput,
            JetInputError,
            Dropzone,
            JetLabel,
            JetSecondaryButton,
            Inertia,
            Datepicker,
            Listbox,
            ListboxButton,
            ListboxLabel,
            ListboxOption,
            ListboxOptions,
            CheckIcon,
            JetValidationErrors,
            SelectorIcon,
        },
        formatDate1(date) {
            const tzOffset = date.getTimezoneOffset() * 60 * 1000;
            return new Date(date - tzOffset).toISOString().split('T')[0];
        },
        data() {
          return{
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            form:this.$inertia.form({
              plan_name:'',
              asset_item:'',
              fund_name_1:'',
              fund_name_2:'',
              fund_name_3:'',
              fund_name_4:'',
              start_date:'',
              end_date:'',
              remark:'',
            }),
            checkin: '',
            errors: '',
          }
        },
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
        methods: {
          formatDate(date) {
            if (date){
            const tzOffset = date.getTimezoneOffset() * 60 * 1000
            return new Date(date - tzOffset).toISOString().split('T')[0]
            }
          },
            createrequisition() {
              if(this.form.start_date && this.form.end_date){
                this.form.start_date =  new Date(this.form.start_date).toISOString().split('T')[0];
                this.form.end_date = new Date(this.form.end_date).toISOString().split('T')[0];
              }
              this.form.post(this.route('fund_table.store'))
            },
        },
    })
</script>
