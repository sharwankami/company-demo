<script>
import {trim} from "lodash/string";

export default {
    props: ['base_route', 'q', 'token', 'onSearch'],
    data(){
        return {searchTerm:""}
    },
    watch:{
        q:{
            immediate:true,
            handler(newVal, oldVal){
                this.searchTerm=newVal;
                this.search();
            }
        }
    },
    methods:{
        search(){
            if(typeof this.onSearch==='function'){
                this.onSearch(this.searchTerm);
            }
        },
        clearSearch(){
            this.searchTerm='';
            this.search();
        },
        isNotEmpty(term){
            return term && trim(term)!=='';
        }
    },
    mounted() {
        //console.log(this.$props.onSearch);
    }
}
</script>
<template>
    <form :action="`${base_route}`" method="get" @submit.prevent="search">
        <div class="input-group">
            <input type="text" v-model="searchTerm" class="form-control" placeholder="Search by organization number">
            <a v-if="isNotEmpty(searchTerm)" class="btn btn-secondary" href="#" @click.prevent="clearSearch">Clear</a>
            <input class="btn btn-secondary" type="submit" value="Search"/>
        </div>
    </form>
</template>
