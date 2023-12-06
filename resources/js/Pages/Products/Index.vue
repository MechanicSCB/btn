<script setup>
let props = defineProps({products: Array});
</script>
<template>
    <div class="w-fit">
        <!-- field names -->
        <div class="py-2 px-6 grid grid-cols-4 uppercase">
            <span class="">Артикул</span>
            <span class="">Название</span>
            <span class="">Статус</span>
            <span class="">Атрибуты</span>
        </div>

        <div class="bg-white">
            <div class="py-3 px-6 border-b grid grid-cols-4" :key="product.id" v-for="product in products">
                <span>{{ product.article }}</span>
                <span>{{ product.name }}</span>
                <span>{{ product.status }}</span>
                <div class="max-w-[150px] flex flex-col">
                    <span v-for="(attr, field) in product.data">{{ field }}: {{ attr }}</span>
                </div>
            </div>
        </div>
    </div>
</template>
