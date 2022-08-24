<script>
import moment from "moment";
import CompanySearch from "./CompanySearch";

export default {
    components: {CompanySearch},
    props:['base_route', 'q', 'token'],
    watch:{
        // q:(newVal, oldVal)=>{
        //     this.searchTerm=newVal;
        // }
    },
    data(){
        return {
            loading:false,
            error:null,
            searchTerm:null,
            pagination:{},
            companies:[]
        }
    },
    methods:{
        moment:moment,
        search(term){
            this.searchTerm=term;
            this.fetchCompanies();
        },
        deleteCompany(e){
            if(!confirm("Are you sure to delete?")){
                return false;
            }
            axios.delete(e.target.action, {_token:this.token, _method:'delete'}).then(res=>{
                this.fetchCompanies();
            }).catch(err=>{
                console.log("err",err.message);
            });
        },
        fetchCompanies(){
            this.loading=true;
            let args={};
            if(this.searchTerm!==null){
                args['q']=this.searchTerm;
            }

            axios.get(this.base_route, {params:args})
                .then(res=>res.data)
                .then(data=>data.companies || {companies:{}})
                .then(companies=>{
                if(typeof companies!=='undefined' && companies!==null){
                    this.companies=companies.data;
                    this.pagination=companies;
                    delete this.pagination.data;
                    //console.log(this.pagination, this.companies);
                }
            }).catch(err=>{
                console.log(err);
            }).then(()=>{
                this.loading=false;
            })
        }
    },
    mounted() {
        console.log(this.$props.q);
        this.fetchCompanies();
    }
}
</script>

<template>
    <div class="companies-list">
        <CompanySearch v-bind="$props" :onSearch="search"/>
        <div v-if="loading">...</div>
        <table class="table">
            <thead>
            <tr>
                <td>Name</td>
                <td>Organization Number</td>
                <td>Created At</td>
                <td>Last Updated At</td>
                <td></td>
                <td></td>
            </tr>
            </thead>
            <tbody>
            <tr v-for="company in this.companies">
                <td>{{company.name}}</td>
                <td>{{company.organization_number}}</td>
                <td>{{moment(company.created_at).utc().format('DD.MM.YYYY')}}</td>
                <td>{{moment(company.updated_at).utc().format('DD.MM.YYYY')}}</td>
                <td><a class="btn btn-sm btn-secondary" :href="`${base_route}/edit/${company.id}`">Edit</a></td>
                <td>
                    <form :action="`${base_route}/delete/${company.id}`" method="post" @submit.prevent="deleteCompany">
                        <input type="hidden" value="delete" name="_method"/>
                        <input type="hidden" v-model="token" name="_token"/>
                        <input type="submit" value="Delete" class="btn btn-primary btn-sm">
                    </form>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
