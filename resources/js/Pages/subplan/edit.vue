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

    <form id="fundform" @submit.prevent="createrequisition()">
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
                              <select id="category" v-model="form.category" name="category" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                <option>請購單</option>
                                <option>印領清冊</option>
                              </select>
                            </div>
                            <div class="col-span-6 sm:col-span-3">
                              <jet-label for="requisition_num" class="block text-sm font-medium text-gray-700">單號</jet-label>
                              <input type="text" v-model="form.requisition_num" name="requisition_num" id="requisition_num" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>

                            <div class="col-span-2">
                              <jet-label for="applicant" class="block text-sm font-medium text-gray-700">申請人</jet-label>
                              <input type="text" v-model="form.applicant" name="applicant" id="applicant" autocomplete="applicant" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>
                            <div class="col-span-2">
                              <jet-label for="amount" class="block text-sm font-medium text-gray-700">選擇處室</jet-label>
                                <div class="mt-1 relative">
                                  <input list="dep_name" type="text" @change="Getfundlist()" v-model="form.dep_name" name="dep_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                                    <datalist id="dep_name" >
                                      <option v-for="dep in deps" :key="dep.dep_id" :value="dep.department" class="mt-1 hover:ring-indigo-500 hover:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"></option>
                                    </datalist>
                                </div>
                            </div>
                            <div class="col-span-6 sm:col-span-3 lg:col-span-2">
                              <jet-label for="amount" class="block text-sm font-medium text-gray-700">核銷金額</jet-label>
                              <input type="text" v-model="form.amount" name="amount" id="amount" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                            </div>


                            <div class="col-span-6 sm:col-span-6">                                  
                                  <Listbox as="div" v-model="selected">
                                    <ListboxLabel class="block text-sm font-medium text-gray-700">
                                    經費來源
                                    </ListboxLabel>
                                    <div class="mt-1 relative">
                                      <ListboxButton class="relative w-full bg-white border border-gray-300 rounded-md shadow-sm pl-3 pr-10 py-2 text-left cursor-default focus:outline-none focus:ring-1 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"  v-model="form.academy">
                                          <span class="ml-3 block truncate" v-if="selected.plan_name">{{ selected.letter_num }}-{{ selected.plan_name }}-{{ selected.fund_name }}</span>
                                          <span class="ml-3 block truncate" v-else>選擇經費</span>
                                        <span class="ml-3 absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                                          <SelectorIcon class="h-5 w-5 text-gray-400" aria-hidden="true" />
                                        </span>
                                      </ListboxButton>

                                      <transition leave-active-class="transition ease-in duration-100" leave-from-class="opacity-100" leave-to-class="opacity-0">
                                        <ListboxOptions class="absolute z-10 mt-1 w-full bg-white shadow-lg max-h-56 rounded-md py-1 text-base ring-1 ring-black ring-opacity-5 overflow-auto focus:outline-none sm:text-sm">
                                          <ListboxOption as="template" v-for="ll in fund_list" :key="ll.dep_id" :value="ll" v-slot="{ active, selected }">
                                            <li :class="[active ? 'text-white bg-indigo-600' : 'text-gray-900', 'cursor-default select-none relative py-2 pl-3 pr-9']">
                                              <div class="flex items-center">
                                                <span :class="[selected ? 'font-semibold' : 'font-normal', 'ml-3 block truncate']">
                                                  {{ ll.letter_num }}-{{ ll.plan_name }}-{{ ll.fund_name }}
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
                                  </Listbox>
                            </div>


                            <div class="col-span-6 sm:col-span-3">
                              <jet-label for="abstract" class="block text-base font-medium text-gray-700">摘要</jet-label>
                              <textarea type="text" v-model="form.abstract" name="abstract" rows="10" id="abstract" autocomplete="abstract" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full text-base border border-gray-300 rounded-md resize-y"></textarea>
                            </div>
                          <div class="col-span-6 sm:col-span-3">
                            <jet-label for="remark" class="block text-base font-medium text-gray-700">
                              備註
                            </jet-label>
                            <div class="mt-1">
                              <textarea id="remark" v-model="form.remark" name="remark" rows="10" class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 mt-1 block w-full text-base border border-gray-300 rounded-md resize-y" placeholder="備註"></textarea>
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
                              <input type="hidden" name="_token" v-bind:value="csrf">
                              <input type="hidden" id="uploadfilename" name="filename" value="123" hidden>
                              <input type="hidden" name="sub_plan_fund_detail_id" v-model="form.sub_plan_fund_detail_id">
                              <input type="hidden" name="requisition_num" v-model="form.requisition_num">
                              <input type="hidden" name="type" value="sub_plan_fund_detail_file">
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
                          </div>
                          </div>
                        </div>

                        <div class="px-4 py-3 bg-gray-50 text-right sm:px-6">
                          <jet-button type="" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save
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
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
import { ref } from 'vue'
import { Listbox, ListboxButton, ListboxLabel, ListboxOption, ListboxOptions } from '@headlessui/vue'
import { CheckIcon, SelectorIcon } from '@heroicons/vue/solid'
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
            Listbox,
            ListboxButton,
            ListboxLabel,
            ListboxOption,
            ListboxOptions,
            CheckIcon,
            SelectorIcon,
            JetValidationErrors,
        },
        setup() {

        },
        props:['sub_strategy','deps','rows','id','files'],//分項,科系
        data() {
          return{
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            form:this.$inertia.form({
              sub_plan_fund_detail_id: this.rows.sub_plan_fund_detail_id,
              category: this.rows.category,
              requisition_num: this.rows.requisition_num,
              fund_item: this.rows.fund_item,
              fund_name: this.rows.fund_name,
              applicant: this.rows.sub_applicant,
              Office: this.rows.Office,
              remark: this.rows.sub_remark,
              amount: this.rows.amount,
              fund_detail_id: this.rows.fund_detail_id,
              selected: {
                plan_name:'',
                letter_num:'',
                fund_name:'',
              },
              abstract: this.rows.abstract,
              indicator: this.rows.indicator,
              dep_name: this.rows.department,
            })
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
            if(this.rows.dep_id){
              let  aa= new FormData;
              aa.append('depid', this.rows.dep_id);
              axios.post(route('loadfund'),aa).then(res => {
                const set = new Set();
                this.fund_list = res.data
              })
            }
            this.fund_list=[{
              "implementation_matter_id": '',
              "department": "",
              "supplement": "",
              "director": "",
              "remark": "",
              "applicant": "",
              "founder": '',
              "dep_id": '',
              "letter_num": "",
              "created_at": "",
              "updated_at": "",
              "fund_id": '',
              "fund_name_id": '2',
              "plan_id": '',
              "assets_item": "",
              "amount": '',
              "estimated_amount": '',
              "reimburse": '',
              "fund_name": "",
              "plan_name": "",
              "start_date": "",
              "end_date": ""
            }]
          this.selected ={
            plan_name:this.rows.plan_name,
            letter_num:this.rows.letter_num,
            fund_name:this.rows.fund_name,
            fund_detail_id:this.rows.fund_detail_id,
          }
        },
        methods: {
            createrequisition() {
              this.form.fund_detail_id= this.selected.fund_detail_id;
              this.form.put(this.route('subplan.update',this.id))
            },
            Getfundlist(){
              let depid = this.deps.find(element => element.department == this.form.dep_name);
              if(depid){
                console.log(depid)
                let  aa= new FormData;
                aa.append('depid', depid.dep_id);
                axios.post(route('loadfund'),aa).then(res => {
                  const set = new Set();
                  this.fund_list = res.data
                })
              }
            }
        },
    })
</script>
