<template>
    <app-layout title="Dashboddard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                請購明細
                <a class="float-right" :href="route('subplan.create')" v-if="$page.props.permission.users.viewAny">
                    <jet-button>新增</jet-button>
                </a>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-8xl mx-auto base:px-6 lg:px-8">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto base:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full base:px-6 lg:px-8">
                        <div class="shadow overflow-hidden border-b border-gray-200 base:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-center text-lg font-medium text-gray-500 uppercase tracking-wider">
                                        執行計畫(分項)
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-cneter text-lg font-medium text-gray-500 uppercase tracking-wider">
                                        經費來源
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider">
                                        申請人(申請處室)
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider">
                                        請購單號
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider">
                                        核銷金額
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider">
                                        核銷狀態
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider">
                                        備註
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider">
                                        建立人
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider">
                                        
                                    </th>
                                </tr>
                            </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                <tr v-for="row in rows" :key="row.sub_plan_fund_detail_id">
                                    <td class="px-6 py-3 whitespace-nowrap">
                                        <div class="flex assets_items-center">
                                        <div class="ml-4">
                                            <div class="text-base font-medium text-gray-900" v-html="handleNewLine1(row.sub)">
                                            </div>
                                        </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-3 text-left whitespace-nowrap">
                                        <div class="flex assets_items-center">
                                        <div class="ml-4">
                                            <div class="text-base font-medium text-gray-900">
                                            {{ row.plan_name }}-{{ row.fund_name }}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                            {{ row.department }}
                                            </div>
                                        </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap">
                                        <div class="text-base text-gray-900 text-left">
                                            {{row.department}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-base text-gray-500">
                                        <div class="text-base text-gray-900 text-left" v-text="row.requisition_num">
                                        </div>
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-base text-gray-500 text-center">
                                        {{ tothousand(row.amount) }}
                                    </td>
                                    <td class="px-6 py-2 whitespace-nowrap text-base text-gray-500 text-left">

                                        <span class="py-1 px-2 inline-flex text-base leading-5 font-semibold rounded-full bg-green-100 text-green-800" v-if="row.status_id==2">
                                         已核銷
                                        </span>
                                        <span class="py-1 px-2 inline-flex text-base leading-5 font-semibold rounded-full bg-red-100 text-green-800" v-if="row.status_id==1">
                                         未核銷
                                        </span>
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-base text-gray-500 text-left" v-html="handleNewLine(row.remark )">
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-base text-gray-500 text-center">
                                        {{ row.name }}
                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-base text-gray-500 text-left">
                                    <a :href="route('subplan.edit', row.sub_plan_fund_detail_id)" class="text-indigo-600 hover:text-indigo-900" v-if="row.status_id==1">修改</a>
                                    <a class="cursor-pointer ml-2 text-indigo-600 hover:text-indigo-900" @click="opencheck(row.sub_plan_fund_detail_id)" v-if="row.status_id==1 && $page.props.user.role=='admin'">核銷</a>
                                    </td>
                                </tr>
                            </tbody>

                            </table>
                        </div>
                        </div>
  <TransitionRoot appear :show="isOpen" as="template">
    <Dialog as="div" @close="closeModal">
      <div class="fixed inset-0 z-10 overflow-y-auto">
        <div class="min-h-screen px-4 text-center">
          <TransitionChild
            as="template"
            enter="duration-300 ease-out"
            enter-from="opacity-0"
            enter-to="opacity-100"
            leave="duration-200 ease-in"
            leave-from="opacity-100"
            leave-to="opacity-0"
          >
            <DialogOverlay class="fixed inset-0" />
          </TransitionChild>

          <span class="inline-block h-screen align-middle" aria-hidden="true">
            &#8203;
          </span>

          <TransitionChild
            as="template"
            enter="duration-300 ease-out"
            enter-from="opacity-0 scale-95"
            enter-to="opacity-100 scale-100"
            leave="duration-200 ease-in"
            leave-from="opacity-100 scale-100"
            leave-to="opacity-0 scale-95"
          >
            <div class="inline-block w-full max-w-sm p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-2xl border-purple-400 border-4">
                <div class="flex items-center justify-between  justify-items-stretch">
                    <div class="w-0 flex-1 justify-self-auto grid justify-items-stretch">
                    <span class="flex p-2 m-auto justify-self-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-14 h-14 text-red-600 justify-items-center" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                        </svg>
                        <span class="flex text-2xl text-center items-center">
                        確定核銷?
                        </span>
                    </span>
                    </div>
                </div>
                <div class="flex items-center justify-between  justify-items-stretch">
                    <div class="w-0 flex-1 grid justify-items-stretch">
                    <span class="flex p-2 m-auto justify-self-end">
                        <div class="m-2 flex">
                            <div class="m-2 flex">
                            <button
                            type="button"
                            class="inline-flex justify-center px-4 py-2 text-base text-white font-black bg-red-600 border border-transparent rounded-md hover:bg-red-500 focus-visible:ring-2 focus-visible:ring-offset-2"
                            @click="closeModal">取消</button>
                        </div>
                        <div class="m-2 flex">
                        <button type="button" class="inline-flex justify-center px-4 py-2 text-base text-white font-black bg-indigo-500 border border-transparent rounded-md hover:bg-indigo-400 focus-visible:ring-2 focus-visible:ring-offset-2" @click="test()" >確定
                        </button>
                        </div>
                        </div>
                    </span>
                    </div>
                </div>
            </div>
          </TransitionChild>
        </div>
      </div>
    </Dialog>
  </TransitionRoot>
                    </div>
                    </div>
            </div>
        </div>
    </app-layout>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetButton from '@/Jetstream/Button.vue'
    import AppLayout from '@/Layouts/AppLayout.vue'
    import { ref } from 'vue'
    import {
    TransitionRoot,
    TransitionChild,
    Dialog,
    DialogOverlay,
    DialogTitle,
    } from '@headlessui/vue'
    export default defineComponent({
        components: {
            AppLayout,
            JetButton,
            TransitionRoot,
            TransitionChild,
            Dialog,
            DialogOverlay,
            DialogTitle,
        },
        props:['rows'],
        methods:{
            handleNewLine(str) {
                if (str){
                    return str.replace(/(?:\r\n|\r|\n)/g,'<br />');
                }
            },
            handleNewLine1(str) {
                if (str)
                    return str.replace(/.{15}\x01?/g,"$&</br>");
            },
            tothousand(num){
                return (num || 0).toString().replace(/(\d)(?=(?:\d{3})+$)/g, '$1,');
            }
        },
        created(){
            let last = [this.rows[0].implementation_matter_name,this.rows[0].sub_strategy];
            this.res=[];
            let data = [];
            let count = 1;
            this.rows.forEach((element,index) => {
                element.sub = element.sub_item_id + '-' + element.sub_num + ' ' + element.target
                if (element.implementation_matter_name == last[0] && element.sub_strategy == last[1]){
                    data.push(element)
                    count ++;
                }
                else{
                    this.res.push({
                        'implementation_matter_name': last[0],
                        'sub_strategy': last[1],
                        'data': data,
                        'count': count,
                    })
                    data=[]
                    count=1
                    data.push(element)
                }
                last = [element.implementation_matter_name,element.sub_strategy];
                if (index == this.rows.length-1){
                    this.res.push({
                        'implementation_matter_name': last[0],
                        'sub_strategy': last[1],
                        'data': data,
                        'count': count,
                    })
                }
            });
        }, 
        setup() {
            const isOpen = ref(false)
            return {
                isOpen,
                closeModal() {
                    isOpen.value = false
                },
                opencheck(id) {
                    isOpen.value = true
                    this.checkid = id
                },
                test(){
                    let aa = new FormData;
                    aa.append('checkid', this.checkid);
                    axios.post(route('check'),aa).then(res => {
                    isOpen.value = false
                    location.reload()
                })
                }
            }
        },
    })
</script>
