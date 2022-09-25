<template>
    <app-layout title="Dashboddard">
      <template #header>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          新增請購
          <a class="float-right" :href="route('subplan.create')">
              <jet-button>新增</jet-button>
          </a>
        </h2>
      </template>

    <form id="fundform" @submit.prevent="">
        <div class="py-12">
            <div class="max-w-7xl mx-auto base:px-6 lg:px-8">
              <div class="mt-10 sm:mt-0">
                <div class="md:grid md:gap-6">
                  <div class="mt-5 md:mt-0 ">
                      <div class="shadow overflow-hidden sm:rounded-md">
                        <div class="px-4 py-5 bg-white sm:p-6">
                          <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-3">
                            <jet-validation-errors class="mb-4" />
                              <jet-label for="category" class="block text-sm font-medium text-gray-700">請購類別</jet-label>
                              <input disabled type="text" v-model="rows.category" name="category" id="category" class="bg-secondary mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                              <jet-label for="requisition_num" class="block text-sm font-medium text-gray-700">單號</jet-label>
                              <input disabled type="text" v-model="rows.requisition_num" name="requisition_num" id="requisition_num" class="bg-secondary mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>

                            <div class="col-span-2">
                              <jet-label for="applicant" class="block text-sm font-medium text-gray-700">申請人</jet-label>
                              <input disabled type="text" v-model="rows.applicant" name="applicant" id="applicant" autocomplete="applicant" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                            <div class="col-span-2">
                              <jet-label for="amount" class="block text-sm font-medium text-gray-700">選擇處室</jet-label>
                                  <input disabled list="dep_name" type="text" v-model="rows.academy" name="dep_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                              <jet-label for="amount" class="block text-sm font-medium text-gray-700">核銷金額</jet-label>
                              <input disabled type="text" v-model="rows.amount" name="amount" id="amount" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>

                            <div class="col-span-6 sm:col-span-6">
                              <jet-label for="amount" class="block text-sm font-medium text-gray-700">經費來源</jet-label>
                              <input disabled type="text" :value="'(' + rows.sub_item_id + '-' + rows.sub_num + ')' + rows.letter_num + '-' + rows.plan_name + '-' +  rows.fund_name + '('+ rows.fund_amount + ')'" name="fund_name" id="fund_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                              <jet-label for="abstract" class="block text-base font-medium text-gray-700">摘要</jet-label>
                              <textarea disabled type="text" v-model="rows.abstract" name="abstract" id="abstract" autocomplete="abstract" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full text-base border border-gray-300 rounded-md resize-y"></textarea>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                              <jet-label for="remark" class="block text-base font-medium text-gray-700">
                                備註
                              </jet-label>
                              <div class="mt-1">
                                <textarea disabled id="remark" v-model="rows.remark" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full text-base border border-gray-300 rounded-md resize-y" placeholder="無" v-if="rows.remark"></textarea>
                                <textarea disabled id="remark" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full text-base border border-gray-300 rounded-md resize-y" placeholder="無" v-else>無</textarea>
                              </div> 
                            </div>
                        
                        <div class="col-span-6 sm:col-span-6">
                          <div v-for="file in files" :key="file.filename" class=" font-medium text-gray-900 bg-white rounded-lg border border-gray-200 dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                            <a target="_blank" :href="'../../sub_plan_fund_detail_file/'+file.requisition_num+ '/' + file.filename"  class="block py-2 px-4 w-full border-gray-200 cursor-pointer hover:bg-gray-100 hover:text-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:border-gray-600 dark:hover:bg-gray-600 dark:hover:text-white dark:focus:ring-gray-500 dark:focus:text-white">
                                {{file.original_filename}}
                            </a>
                          </div>
                        </div>
                        <div class="col-span-6 sm:col-span-6">
                            <label class="block text-base font-medium text-gray-700">
                              檔案上傳
                            </label>
                            <form action="{{ route('dropzone.upload') }}" class="dropzone mt-1  px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md" id="my-great-dropzone" >
                              <input disabled type="hidden" name="_token" v-bind:value="csrf">
                              <input disabled type="hidden" id="uploadfilename" name="filename" value="" hidden>
                              <input disabled type="hidden" name="sub_plan_fund_detail_id" v-model="rows.sub_plan_fund_detail_id">
                              <input disabled type="hidden" name="requisition_num" v-model="rows.requisition_num">
                              <input disabled type="hidden" name="type" value="sub_plan_fund_detail_file">
                              <div class="dz-message">
                              <div class="space-y-1 text-center">
                                
                                <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                                  <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                                <div class=" text-sm text-gray-600">
                                  <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                    <span>Upload a file</span>
                                    <input disabled id="file-upload" name="file-upload" type="file" class="sr-only" multiple />
                                  </label>
                                  <p class="pl-1">or drag and drop</p>
                                </div>
                                <p class="text-xs text-gray-500">
                                  PDF, PNG, JPG, GIF up to 10MB
                                </p>
                              </div> 
                              </div>
                            </form>
                          </div>
                          </div>
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
            JetLabel,
            JetSecondaryButton,
            Inertia,
            JetValidationErrors,
        },
        setup() {

        },
        props:['sub_strategy','deps','rows','id','files'],//分項,科系
        data() {
          return{
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
          }
        },
        mounted() {
          if (document.getElementById('my-great-dropzone')) {
            Dropzone.options.myGreatDropzone = {
              url: route('dropzone.upload'),
              uploadMultiple: false,
              autoProcessQueue: true,
              init: function fileupload(){
                  this.on("addedfile", function(file) { 
                  document.getElementById('uploadfilename').value = file.name
                });
              },
               success:function(file, response)
              {
                  console.log(response)
                  return file.previewElement.classList.add("dz-success");
              },
            };
          }
        },
        created() {
        },
        methods: {
        },
    })
</script>
