<script>

export default {
    props: ['company']
}
</script>
<template>
    <dl>
        <dt>Company name</dt><dd>{{company.name}} </dd>
        <dt>Organization number</dt><dd>{{company.organization_number}} </dd>
        <dt>Street name</dt><dd>{{company.street_name}} </dd>
        <dt>House number</dt><dd>{{company.house_number}} </dd>
        <dt>Zipcode</dt><dd>{{company.zip_code}} </dd>
        <dt>Country</dt><dd>{{company.country}} </dd>
        <dt>Phone</dt><dd>{{company.phone}} </dd>
        <dt>Email</dt><dd>{{company.email}} </dd>
    </dl>
</template>
