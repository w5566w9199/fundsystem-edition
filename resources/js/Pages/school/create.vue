<template>
    <app-layout title="新增處室">
        <template #header>
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
              新增處室
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
                              <jet-label for="academy" class="block text-sm font-medium text-gray-700">學院<a class="text-red-500">*</a> </jet-label>
                              <input type="text" v-model="form.academy" name="academy" id="academy" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                            </div>
                            <div class="col-span-12">
                              <jet-validation-errors class="mb-4" />
                              <jet-label for="department" class="block text-sm font-medium text-gray-700">處室<a class="text-red-500">*</a> </jet-label>
                              <input type="text" v-model="form.department" name="department" id="department" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" >
                            </div>

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
        },
        formatDate1(date) {
            const tzOffset = date.getTimezoneOffset() * 60 * 1000;
            return new Date(date - tzOffset).toISOString().split('T')[0];
        },
        data() {
          return{
            form:this.$inertia.form({
              academy:'',
              department:'',
            }),
            checkin: '',
            errors: '',
          }
        },
        created() {
        },
        methods: {
            createrequisition() {
              this.form.post(this.route('school.store'))
            },
        },
    })
</script>
