<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                經費總表
                <a class="float-right" :href="route('fund_table.create')"  :active="route().current('fund_table.*')">
                <!-- <a class="float-right" :href="route('fund_table.create')" v-if="$page.props.permission.users.viewAny"> -->
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
                                    計畫名稱(項目)
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-lg font-medium text-gray-500 uppercase tracking-wider">
                                    經費名稱
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-lg font-medium text-gray-500 uppercase tracking-wider">
                                    已核銷/總額
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-lg font-medium text-gray-500 uppercase tracking-wider">
                                    核銷中
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-lg font-medium text-gray-500 uppercase tracking-wider">
                                    剩餘金額
                                </th>
                                <th scope="col" class="px-6 py-3 text-center text-lg font-medium text-gray-500 uppercase tracking-wider">
                                    執行率
                                </th>
                                <!-- <th scope="col" class="relative px-6 py-3">
                                    <span class="sr-only">Edit</span>
                                </th> -->
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <template v-for="rr in res" :key="rr.fund_name">
                                    <td class="px-6 py-4 whitespace-nowrap" rowspan="6">
                                        <div class="flex assets_items-center">
                                        <div class="ml-4">
                                            <div class="text-base font-medium text-gray-900">
                                            {{ rr.planname}}
                                            </div>
                                            <div class="text-sm text-gray-500">
                                            {{ rr.assets_item}}
                                            </div>
                                        </div>
                                        </div>
                                    </td>
                                    <tr v-for="fund in rr.data" :key="fund.fund_name">
                                    <td class="px-6 py-4 text-center whitespace-nowrap">
                                        {{fund.fund_name}}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-base text-gray-900 text-center">
                                            {{tothousand(fund.reimburse)}} / {{tothousand(fund.amount)}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-base text-gray-500">
                                        <div class="text-base text-gray-900 text-center">
                                            {{tothousand(fund.estimated_amount)}} / {{tothousand(fund.amount)}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-base text-gray-500">
                                        <div class="text-base text-gray-900 text-center">
                                            {{tothousand(fund.amount - fund.estimated_amount - fund.reimburse)}}
                                        </div>
                                    </td>
                                    <td class="px-6 py-2 whitespace-nowrap text-base text-gray-500">
                                        <div id="app">
                                            <div class="row">
                                                    <svg class="radial-progress" :data-percentage="rate(fund.reimburse ,fund.amount)" viewBox="0 0 80 80">
                                                    <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                                                    <circle class="complete" cx="40" cy="40" r="35"></circle>
                                                    <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)" v-text="rate(fund.reimburse ,fund.amount) + '%'"></text></svg>
                                            </div>
                                        </div>
                                    </td>
                                    </tr>
                                </template>
                            </tbody>
                            </table>
                        </div>
                        </div>
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
    export default defineComponent({
        data: function(){
        return {
            time: 2000,
            list: [
                {id: 1, percentage: 30},
            ],
        }
	  },
        components: {
            AppLayout,
            JetButton
        },
        props:['funds'],
        methods:{
            rate(a,b){
                if(Number.isFinite(Math.round(a/b*10000)/100))
                    return Math.round(a/b*10000)/100;
                else
                    return 0;
            },
            tothousand(num){
                return (num || 0).toString().replace(/(\d)(?=(?:\d{3})+$)/g, '$1,');
            }
        },
        created(){
            let last = [this.funds[0].plan_name,this.funds[0].assets_item];
            this.res=[];
            let data = [];
            let total=[0,0,0];
            // let total=[];
            this.funds.forEach((element,index) => {
                if (element.plan_name == last[0] && element.assets_item == last[1]){
                    data.push(element);
                    total[0]+=parseInt(element.amount);
                    total[1]+=parseInt(element.estimated_amount);
                    total[2]+=parseInt(element.reimburse);
                }
                else{
                    data.push({
                        'amount' : total[0],
                        'estimated_amount' : total[1],
                        'reimburse' : total[2],
                        'fund_name' : '合計',
                    });
                    this.res.push({
                        'planname': last[0],
                        'assets_item': last[1],
                        'data': data,
                    });
                    data=[];
                    total=[parseInt(element.amount),parseInt(element.estimated_amount),parseInt(element.reimburse)];
                    data.push(element);
                }
                last = [element.plan_name,element.assets_item];
                if (index == this.funds.length-1){
                    data.push({
                        'amount' : total[0],
                        'estimated_amount' : total[1],
                        'reimburse' : total[2],
                        'fund_name' : '合計',
                    });
                    this.res.push({
                        'planname': last[0],
                        'assets_item': last[1],
                        'data': data,
                    })
                }
            });
            this.res = this.res.reverse()
        },
        mounted: function () {
            this.$nextTick(function () {
                    $('svg.radial-progress').each(function( index, value ) {
                        $(this).find($('circle.complete')).removeAttr( 'style' );
                    });
                $('svg.radial-progress').each(function( index, value ) {
                    const percent = value['dataset']['percentage'];
                    const radius = $(this).find($('circle.complete')).attr('r');
                    const circumference = 2 * Math.PI * radius;
                    const strokeDashOffset = circumference - ((percent * circumference) / 100);
                    $(this).find($('circle.complete')).animate({'stroke-dashoffset': strokeDashOffset}, 1000);
                });
            })
        },
    });



    </script>
