<script>

export default {
    props: ['base_route', 'token', 'companyId', 'onUpdate'],
    data(){
        return {
            form:{},
            fields:[],
            countries:[],
            editing:false,
            company:{}
        }
    },
    mounted() {
        //console.log(this.$props.company);
        this.loadCompany();
    },
    watch:{
        company:{
            immediate:true,
            handler(newVal, oldVal){
                //this.loadCompany(newVal);
            }
        }
    },
    methods:{
        saveCompany(e){
            let postUrl=`${this.base_route}/update/`;
            if(this.company.id>0){
                postUrl+=this.company.id;
            }

            axios.post(postUrl, this.form)
            .then(res=>{
                console.log(this.onUpdate);
                if(typeof this.onUpdate==='function'){
                    this.onUpdate(null);
                }
                console.log(res);
            })
            .catch(err=>{
                console.log(err);
            })
        },
        loadCompany(){
            let getUrl=`${this.base_route}/edit/`;
            if(this.companyId>0){
                getUrl+=this.companyId;
            }else{
                getUrl=this.base_route+"/new";
            }
            console.log(getUrl);
            axios.get(getUrl).then(res=>{
                let data=res.data;

                if(typeof data!=='undefined'){
                    this.company=data.company || {};
                    this.countries=data.countries || [];
                    this.editing=data.editing || false;

                    const fieldNames=data.fields || [];
                    fieldNames.map(n=>{
                        this.form[n]=this.company[n];
                    });

                    let fields=[];
                    for(let fieldName of fieldNames){
                        fields.push({
                            options:(fieldName=='country')?this.countries:[],
                            type:(fieldName=='country')?'select':'text',
                            name:fieldName,
                            label:fieldName,
                            value:this.company[fieldName]
                        });
                    }
                    this.fields=fields;
                }
            }).catch(err=>{
                console.log('err', err);
            });
        }
    }
}
</script>
<template>
    <div>
        <form action="" method="post" @submit.prevent="saveCompany">
        <template v-for="field in this.fields">
            <div>
                <div class="mb-3">
                    <label >{{field.label}}</label>
                    <select v-if="field.type==='select'" v-model="form[field.name]" :name="field.name" :id="field.name" class="form-control">
                        <option value="">Select {{field.label}}</option>
                        <option v-for="option in field.options" :value="option.code">{{option.name}}</option>
                    </select>
                    <input v-else v-model="form[field.name]" :type="field.type" class="form-control" :value="field.value"/>
                </div>
            </div>
        </template>
            <input type="submit" class="btn btn-primary btn-sm" value="Save Company"/>
        </form>
    </div>
</template>
