<template>
    <app-layout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                執行計畫
                <a v-text="session"></a>
                <a class="float-right" :href="route('implementation_matter.create')">
                    <jet-button>新增</jet-button>
                </a>
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-8xl mx-auto base:px-6 lg:px-8">
                <div class="flex flex-col">
                    <div class="-my-2 overflow-x-auto base:-mx-6 lg:-mx-8">
                        <div class="py-2 align-middle inline-block min-w-full base:px-6 lg:px-8  max-h-screen-90">
                        <div class="shadow overflow-hidden border-b border-gray-200 base:rounded-lg">
                            <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                <th scope="col" class="px-6 py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider">
                                    執行計畫(分項)
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider">
                                    經費來源
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider">
                                    申請人(申請處室)
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider">
                                    簽呈編號/主旨
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider">
                                    已核銷/總額
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider">
                                    核銷中
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider">
                                    執行率
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider">
                                    備註
                                </th>
                                <th scope="col" class="px-6 py-3 text-left text-lg font-medium text-gray-500 uppercase tracking-wider">
                                    
                                </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <template v-for="rr in res" :key="rr.implementation_matter_name">
                                    <td class="px-6 py-4 whitespace-nowrap" :rowspan="rr.count">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-base font-medium text-gray-900" v-html="handleNewLine(rr.implementation_matter_name)">
                                                </div>
                                                <div class="text-sm text-gray-500">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                <tr v-for="row in rr.data" :key="row.implementation_matter_id">
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-base text-gray-900">{{row.plan_name}}</div>
                                            <div class="text-sm text-gray-500" v-if="row.assets_item">{{ row.assets_item}} - {{ row.fund_name}}</div>
                                            <div class="text-sm text-gray-500" v-else></div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-base text-gray-900" v-if="row.department">{{row.department}}-{{row.applicant}}</div>
                                        <div class="text-base text-gray-900" v-else></div>
                                            <div class="text-sm text-gray-500">
                                            {{ row.director }}
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-base text-gray-500">
                                        <div class="flex items-center">
                                            <div class="ml-4">
                                                <div class="text-base font-medium text-gray-900">
                                                    {{row.letter_num}}
                                                </div>
                                                <div class="text-sm text-gray-500"  v-html="handleNewLine(row.implementation_matter_name)">
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-base text-gray-500">
                                        <div class="text-base text-gray-900">{{tothousand(row.reimburse)}} / {{tothousand(row.amount)}}</div>
                                            <div class="text-sm text-gray-500">
                                            {{rate(row.reimburse ,row.amount)}} %
                                            </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-base text-gray-500">
                                        <div class="text-base text-gray-900">{{tothousand(row.estimated_amount)}} / {{tothousand(row.amount)}}</div>
                                            <div class="text-sm text-gray-500">
                                            {{rate(row.estimated_amount ,row.amount)}} %
                                        </div>
                                    </td>
                                    <td class="px-2 py-2 whitespace-nowrap text-base text-gray-500">
                                        <!-- <div id="app"> -->
                                            <div class="row">
                                                    <svg class="radial-progress" :data-percentage="rate(row.reimburse ,row.amount)" viewBox="0 0 80 80">
                                                    <circle class="incomplete" cx="40" cy="40" r="35"></circle>
                                                    <circle class="complete" cx="40" cy="40" r="35"></circle>
                                                    <text class="percentage" x="50%" y="57%" transform="matrix(0, 1, -1, 0, 80, 0)" v-text="rate(row.reimburse ,row.amount) + '%'"></text></svg>
                                            </div>
                                        <!-- </div> -->
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap" v-html="tobr(row.remark)">

                                    </td>
                                    <td class="px-6 py-3 whitespace-nowrap text-base text-gray-500 text-left">
                                    <a :href="route('implementation_matter.edit', row.implementation_matter_id)" class="text-indigo-600 hover:text-indigo-900" v-if="row.implementation_matter_id">修改</a>
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
        components: {
            AppLayout,
            JetButton
        },
        props:['rows'],
        methods:{
            rate(a,b){
                if (isNaN(Math.round(a/b*10000)/100))
                    return 0
                else
                    return Math.round(a/b*10000)/100
            },
            tobr(text){
              if (text != undefined)
                return text.replace(/\n/g,'<br>')
            },
            handleNewLine(str) {
                if (str)
                    return str.replace(/.{10}\x01?/g,"$&</br>");
            },
            tothousand(num){
                if(num==0)
                    return 0
                else (num)
                    return (num || 0).toString().replace(/(\d)(?=(?:\d{3})+$)/g, '$1,');
            },
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
        created(){
            if (this.rows.length > 1){
            let last = [this.rows[0].sub_item_id + '-' + this.rows[0].sub_num + this.rows[0].target,this.rows[0].sub_id];
            this.res=[];
            let data = [];
            let count = 1;
            let total=[0,0,0];
            this.rows.forEach((element,index) => {
                if (element.sub_item_id  + '-' + this.rows[index].sub_num + this.rows[index].target == last[0] && element.sub_id == last[1]){
                    data.push(element)
                    total[0]+=parseInt(element.amount);
                    total[1]+=parseInt(element.estimated_amount);
                    total[2]+=parseInt(element.reimburse);
                    count ++;
                }
                else{
                    data.push({
                        'amount' : total[0],
                        'estimated_amount' : total[1],
                        'reimburse' : total[2],
                        'plan_name' : '合計',
                    });
                    this.res.push({
                        'implementation_matter_name': last[0],
                        'sub_strategy': last[1],
                        'data': data,
                        'count': count+1,
                    })
                    data=[]
                    total=[parseInt(element.amount),parseInt(element.estimated_amount),parseInt(element.reimburse)];
                    count=2
                    data.push(element)
                    last = [element.sub_item_id  + '-' + element.sub_num + element.target,element.sub_id];
                }
                if (index == this.rows.length-1){
                    data.push({
                        'amount' : total[0],
                        'estimated_amount' : total[1],
                        'reimburse' : total[2],
                        'plan_name' : '合計',
                    });
                    this.res.push({
                        'implementation_matter_name': last[0],
                        'sub_strategy': last[1],
                        'data': data,
                        'count': count+1,
                    })
                }
            });
        }
        },
    })
</script>
