<script>
import moment from "moment";
import CompanySearch from "./CompanySearch";
import CompanyDetails from "./CompanyDetails";
import CompanyForm from "./CompanyForm";

export default {
    components: {CompanyForm, CompanyDetails, CompanySearch},
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
            companies:[],
            selectedCompany:null,
            selectedCompanyIdForEdit:null
        }
    },
    methods:{
        moment:moment,
        editCompany(companyId){
            let selectedCompanyForEdit=this.companies.find(c=>c.id===companyId);
            if(typeof selectedCompanyForEdit!=='undefined'){
                this.selectedCompanyIdForEdit=companyId;
            }else{
                if(companyId!==null){
                    this.selectedCompanyIdForEdit=0;
                }else{
                    this.selectedCompanyIdForEdit=null;
                }
            }
        },
        showCompany(selectedCompanyId){
            let selectedCompany=this.companies.find(c=>c.id===selectedCompanyId);
            if(typeof selectedCompany!=='undefined'){
                this.selectedCompany=selectedCompany;
            }else{
                this.selectedCompany=null;
            }
        },
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
        //console.log(this.$props.q);
        this.fetchCompanies();
    }
}
</script>

<template>
    <div class="companies-list">
        <div v-if="selectedCompany !== null">
            <p><a href="#" @click.prevent="showCompany(null)">back</a></p>
            <CompanyDetails  :company="selectedCompany" />
        </div>

        <div v-if="selectedCompanyIdForEdit !== null">
            <p><a href="#" @click.prevent="editCompany(null)">back</a></p>
            <CompanyForm  :companyId="selectedCompanyIdForEdit" :base_route="base_route" :token="token" :onUpdate="editCompany"/>
        </div>

        <div v-if="selectedCompany===null && selectedCompanyIdForEdit===null">
            <p><a class="btn btn-sm btn-primary" href="#" @click.prevent="editCompany(0)">Add New Company</a></p>
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
                    <td><a href="#" @click.prevent="showCompany(company.id)">{{company.name}}</a></td>
                    <td>{{company.organization_number}}</td>
                    <td>{{moment(company.created_at).utc().format('DD.MM.YYYY')}}</td>
                    <td>{{moment(company.updated_at).utc().format('DD.MM.YYYY')}}</td>
<!--                    <td><a class="btn btn-sm btn-secondary" :href="`${base_route}/edit/${company.id}`">Edit</a></td>-->
                    <td><a @click.prevent="editCompany(company.id)" class="btn btn-sm btn-secondary" :href="`${base_route}/edit/${company.id}`">Edit</a></td>
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

    </div>
</template>
