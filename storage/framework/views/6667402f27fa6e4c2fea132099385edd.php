<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-bold text-3xl text-gray-900 leading-tight">
            <?php echo e(__('Semua Laporan Warga')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12 bg-gradient-to-br from-green-50 via-white to-emerald-50">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            
            <?php if(session('success')): ?>
                <div class="mb-6 bg-green-100 border-l-4 border-green-500 text-green-800 p-4 rounded-lg shadow-sm">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            
            <?php if(auth()->guard()->check()): ?>
                <div class="flex justify-end mb-8">
                    <a href="<?php echo e(route('laporan.create')); ?>"
                       class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-700 text-white font-semibold rounded-full shadow-md hover:shadow-lg hover:scale-[1.03] transition transform duration-200 ease-in-out">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" stroke-width="2"
                             viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="M12 4v16m8-8H4"></path>
                        </svg>
                        Buat Laporan Baru
                    </a>
                </div>
            <?php endif; ?>

            
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php $__empty_1 = true; $__currentLoopData = $laporans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $laporan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-2xl transform hover:scale-[1.02] transition duration-300 group">
                        
                        
                        <?php if($laporan->foto): ?>
                            <img src="<?php echo e(asset('storage/' . $laporan->foto)); ?>"
                                 alt="Foto Laporan <?php echo e($laporan->judul); ?>"
                                 class="w-full h-48 object-cover group-hover:opacity-95 transition duration-300">
                        <?php else: ?>
                            <div class="w-full h-48 bg-gray-100 flex items-center justify-center text-gray-400 italic">
                                Tidak ada foto
                            </div>
                        <?php endif; ?>

                        
                        <div class="p-6">
                            <h3 class="font-extrabold text-xl text-gray-800 mb-1"><?php echo e($laporan->judul); ?></h3>
                            <p class="text-sm text-gray-600 mb-2">📍 <?php echo e($laporan->lokasi); ?></p>

                            <p class="text-xs text-gray-500 mb-3">
                                Oleh <span class="font-semibold text-gray-700"><?php echo e($laporan->user->name); ?></span> •
                                <?php echo e($laporan->created_at->format('d M Y')); ?>

                            </p>

                            
                            <?php
                                $statusColors = [
                                    'Selesai' => 'bg-green-100 text-green-700',
                                    'Diproses' => 'bg-yellow-100 text-yellow-700',
                                    'Pending' => 'bg-red-100 text-red-700',
                                    'default' => 'bg-gray-100 text-gray-700',
                                ];
                                $statusColor = $statusColors[$laporan->status] ?? $statusColors['default'];
                            ?>

                            <span class="inline-block px-3 py-1 text-xs font-semibold rounded-full <?php echo e($statusColor); ?>">
                                <?php echo e($laporan->status); ?>

                            </span>

                            
                            <div class="mt-5">
                                <a href="<?php echo e(route('laporan.show', $laporan->id)); ?>"
                                   class="inline-flex items-center text-emerald-700 font-semibold hover:text-emerald-800 hover:underline transition duration-200">
                                    <span>Lihat Detail</span>
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" stroke-width="2"
                                         viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="col-span-full text-center text-gray-500 text-lg mt-10">
                        Belum ada laporan yang dibuat 😢
                    </p>
                <?php endif; ?>
            </div>

            
            <div class="mt-10 flex justify-center">
                <?php echo e($laporans->links()); ?>

            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\LaporLingkungan\resources\views/home.blade.php ENDPATH**/ ?>