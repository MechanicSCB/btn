<script setup>
import {inject, ref} from "vue";
import CloseCross from "@/Svg/CloseCross.vue";
import {useForm} from "@inertiajs/vue3";
import TrashIcon from "@/Svg/TrashIcon.vue";

let props = defineProps({product: Object});
let showCreateModal = inject('showCreateModal');
let editedProductId = inject('editedProductId');

let form = useForm({
    'article': props.product?.article ?? '',
    'name': props.product?.name ?? '',
    'status': props.product?.status ?? 'available',
    'datum': props.product?.data ?? [],
});

let submit = () => {
    if(props.product){
        form.put(route('products.update', props.product), {
            preserveScroll: true,
        });
    }else {
        form.post(route('products.store'), {
            preserveScroll: true,
            onSuccess: () => form.reset(),
        });
    }
};

let showOptions = ref(false);
</script>
<template>
    <div @click="showCreateModal=false;editedProductId=null"
         class="fixed z-10 left-0 top-0 w-full h-screen py-20 px-4 bg-[rgba(0,0,0,0.7)] flex items-center justify-center cursor-pointer"
    >
        <div @click.stop="showOptions=false"
             class="relative w-full max-w-[750px] max-h-screen text-white bg-[#374050] py-5 px-3 cursor-default overflow-y-auto">
            <!-- Close Modal List Button -->
            <CloseCross @click="showCreateModal=false;editedProductId=null"
                        class="m-1 w-8 absolute top-4 right-0 cursor-pointer text-gray-400"/>

            <h2 class="text-xl font-semibold mb-3">{{ product ? 'Редактировать ' + product.name : 'Добавить продукт' }}</h2>

            <form @submit.prevent="submit" class="max-w-[550px] flex flex-col gap-2 pb-4">
                <div>
                    <label class="text-xxs">Артикул</label>
                    <input v-model="form.article"
                           class="h-8 w-full rounded-lg text-gray-700"
                           :class="{' cursor-not-allowed': !$page.props.auth.user['is_admin']}"
                           :disabled="! $page.props.auth.user['is_admin']"
                           required/>
                    <div class="text-red-600 text-xxs h-0">{{ form.errors.article }}</div>
                </div>
                <div>
                    <label class="text-xxs">Название</label>
                    <input class="h-8 w-full rounded-lg text-gray-700" v-model="form.name" required/>
                    <div class="-mt-0.5 text-red-600 text-xxs h-0">{{ form.errors.name }}</div>
                </div>

                <!-- Status select -->
                <div class="flex flex-col">
                    <label class="text-xxs">Статус</label>
                    <div class="mt-1 relative text-gray-700 text-xs">
                        <div @click.stop="showOptions=!showOptions"
                             class="h-7 flex items-center px-3 rounded-md bg-white border-b"
                             :class="{'rounded-b-none':showOptions}"
                        >
                            {{ form.status === 'available' ? 'Доступен' : 'Не доступен' }}
                        </div>
                        <div @click.stop="showOptions=false" v-if="showOptions"
                             class="absolute bg-white w-full rounded-b-md cursor-pointer overflow-hidden">
                            <div @click="form.status='available'"
                                 :class="{'bg-[#50A9FC]':form.status==='available'}"
                                 class="py-1.5 px-3 hover:bg-gray-400"
                            >Доступен
                            </div>
                            <div @click="form.status='unavailable'"
                                 :class="{'bg-[#50A9FC]':form.status==='unavailable'}"
                                 class="py-1.5 px-3 hover:bg-gray-400"
                            >Не доступен
                            </div>
                        </div>
                    </div>
                    <span class="text-red-600 text-xs">{{ form.errors.status }}</span>
                </div>

                <!-- Attributes -->
                <div>
                    <h2 class="mt-2 text-sm font-semibold">Атрибуты</h2>
                    <div v-for="(item, itemId) in form.datum" class="mt-2 flex gap-2">
                        <div>
                            <label class="text-xxs">Название</label>
                            <input class="w-full h-8 rounded-lg text-gray-700" v-model="form.datum[itemId].field"/>
                        </div>
                        <div>
                            <label class="text-xxs">Значение</label>
                            <input class="w-full h-8 rounded-lg text-gray-700" v-model="form.datum[itemId].value"/>
                        </div>
                        <TrashIcon @click="form.datum.splice(itemId, 1)"
                                   class="mt-8 w-4 h-4 fill-gray-400 hover:fill-red-500 cursor-pointer"/>
                    </div>

                    <!--  Add attribute  -->
                    <div @click="form.datum.push({'field':'', 'value':''})"
                         class="mt-2 text-xxs text-[#0FC5FF] hover:text-sky-300 cursor-pointer">+ Добавить атрибут
                    </div>
                </div>


                <button
                    class="mt-6 w-fit py-2 px-10 rounded-md text-white bg-[#0FC5FF] hover:bg-sky-600 text-xs cursor-pointer"
                    :disabled="form.processing">
                    Сохранить
                </button>
            </form>
        </div>
    </div>
</template>
