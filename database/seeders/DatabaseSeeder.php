<?php

namespace Database\Seeders;

use App\Models\PostBlog;
use App\Models\Producto;
use App\Models\TipoPost;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // ── Usuario administrador ──────────────────────────────────────
        User::firstOrCreate(
            ['email' => 'admin@agrivall.com'],
            [
                'name'     => 'Administrador Agrivall',
                'password' => bcrypt('agrivall2026'),
                'is_admin' => true,
            ]
        );

        // ── Productos ──────────────────────────────────────────────────
        $productos = [
            ['nombre' => 'Cerezas',      'formato' => '1 kg', 'precio' => 6.50,  'imagen' => 'images/cerezas1K.png'],
            ['nombre' => 'Cerezas',      'formato' => '4 kg', 'precio' => 22.00, 'imagen' => 'images/cerezas4K.png'],
            ['nombre' => 'Albaricoques', 'formato' => '1 kg', 'precio' => 4.25,  'imagen' => 'images/albaricoque1K.png'],
            ['nombre' => 'Albaricoques', 'formato' => '4 kg', 'precio' => 15.00, 'imagen' => 'images/albaricoque4K.png'],
            ['nombre' => 'Nueces',       'formato' => '1 kg', 'precio' => 8.75,  'imagen' => 'images/nueces1K.png'],
            ['nombre' => 'Nueces',       'formato' => '4 kg', 'precio' => 32.00, 'imagen' => 'images/nueces4k.png'],
            ['nombre' => 'Hierbas',      'formato' => '1 kg', 'precio' => 5.50,  'imagen' => 'images/hierbas.png'],
        ];

        foreach ($productos as $datos) {
            Producto::updateOrCreate(
                ['nombre' => $datos['nombre'], 'formato' => $datos['formato']],
                ['precio' => $datos['precio'], 'imagen' => $datos['imagen'], 'disponible' => true]
            );
        }

        // ── Tipos de post ──────────────────────────────────────────────
        foreach (['Noticias', 'Consejos', 'Recetas'] as $tipo) {
            TipoPost::firstOrCreate(['tipo' => $tipo]);
        }

        $noticias = TipoPost::where('tipo', 'Noticias')->first();
        $consejos = TipoPost::where('tipo', 'Consejos')->first();
        $recetas  = TipoPost::where('tipo', 'Recetas')->first();

        // ── Posts del blog ─────────────────────────────────────────────
        $posts = [
            [
                'titulo'       => 'Temporada de cerezas: todo lo que necesitas saber',
                'noticia'      => '<p>Las cerezas ecológicas de Agrivall maduran bajo el sol de primavera y llegan directas del árbol a tu mesa. Cultivadas sin pesticidas, con un suelo cuidado durante años, cada cereza concentra en su interior todo el sabor que la naturaleza puede ofrecer.</p><h2>¿Cuándo es el mejor momento para comprarlas?</h2><p>La temporada de cerezas en nuestra zona comienza a finales de abril y se extiende hasta principios de julio, dependiendo de la variedad y las condiciones climáticas de cada año. Las primeras en llegar son las más dulces; a medida que avanza la temporada aparecen variedades más ácidas, perfectas para mermeladas y repostería.</p><blockquote>Una cereza recién cogida del árbol es uno de los placeres más puros que puede ofrecer la naturaleza.</blockquote><h2>Cómo conservarlas correctamente</h2><p>Las cerezas son delicadas y se deterioran rápidamente si no se guardan bien. Lo ideal es mantenerlas en el frigorífico dentro de un recipiente semi-abierto, sin lavarlas hasta el momento de consumirlas. Así pueden aguantar perfectamente entre 5 y 7 días sin perder frescura.</p><ul><li>Guárdalas sin lavar en el frigorífico.</li><li>Usa un recipiente con algo de ventilación.</li><li>Consúmelas en los primeros 7 días.</li><li>Retira las que estén dañadas para que no afecten al resto.</li></ul><h2>Por qué son especiales las variedades de Agrivall</h2><p>En Agrivall cultivamos variedades autóctonas adaptadas al microclima de nuestra zona. Esto no solo garantiza un sabor superior, sino que también reduce la necesidad de intervenciones externas: árboles más resistentes, menos plagas, más equilibrio natural.</p>',
                'fecha_public' => '2026-05-02',
                'imagen'       => 'blog/temporadaCerezas.jpeg',
                'tipo_post_id' => $noticias->id,
            ],
            [
                'titulo'       => 'Los beneficios de la agricultura ecológica para tu salud',
                'noticia'      => '<p>Cada vez más estudios confirman que los productos cultivados sin pesticidas aportan más nutrientes y menos residuos químicos. La agricultura ecológica no solo cuida el medioambiente, sino también tu salud.</p><h2>Más nutrientes, menos tóxicos</h2><p>Un alimento ecológico puede contener hasta un 50% más de antioxidantes que su equivalente convencional, según investigaciones recientes de la Universidad de Newcastle. Esto se debe a que las plantas, al no recibir fertilizantes de síntesis, producen más compuestos protectores por sí mismas.</p><h2>Sin residuos de pesticidas</h2><p>Los productos convencionales pueden contener residuos de hasta 50 plaguicidas distintos. Los ecológicos, sometidos a controles estrictos, garantizan la ausencia de estos compuestos en lo que llevas a tu mesa.</p><blockquote>Comer ecológico es una inversión en salud, no un lujo.</blockquote><h2>Mejor sabor, más biodiversidad</h2><p>Los suelos sanos producen alimentos con más sabor. La biodiversidad que preserva la agricultura ecológica se traduce directamente en la riqueza organoléptica de cada producto.</p>',
                'fecha_public' => '2026-04-18',
                'imagen'       => 'blog/sello.jpeg',
                'tipo_post_id' => $noticias->id,
            ],
            [
                'titulo'       => 'Cómo conservar las nueces durante todo el invierno',
                'noticia'      => '<p>La nuez ecológica es uno de los frutos secos más saludables, pero requiere ciertas condiciones de almacenamiento para no perder sus propiedades. Sigue estos consejos y tendrás nueces en perfecto estado durante meses.</p><h2>La clave: frío, oscuridad y poca humedad</h2><p>Las nueces con cáscara se conservan perfectamente en un lugar fresco y seco durante 3-4 meses. Sin cáscara, lo ideal es guardarlas en un recipiente hermético en el frigorífico, donde aguantan hasta 6 meses.</p><ul><li>Con cáscara: lugar fresco y oscuro, hasta 4 meses.</li><li>Sin cáscara en nevera: recipiente hermético, hasta 6 meses.</li><li>Congeladas: hasta 1 año sin perder propiedades.</li><li>Evita la humedad: acelera el enranciamiento.</li></ul><h2>Cómo detectar si están en mal estado</h2><p>Una nuez rancia tiene un olor a pintura o aceite viejo muy característico. Si al probarla notas un sabor amargo o desagradable, descártala. El color también puede dar pistas: la carne no debe ser oscura ni tener manchas.</p>',
                'fecha_public' => '2026-04-05',
                'imagen'       => 'blog/nueces.jpeg',
                'tipo_post_id' => $consejos->id,
            ],
            [
                'titulo'       => '5 recetas fáciles con albaricoques de temporada',
                'noticia'      => '<p>El albaricoque ecológico es versátil en la cocina: mermeladas, tartas, salsas y ensaladas. Te proponemos cinco recetas sencillas para aprovechar la temporada y no dejar pasar esta fruta tan especial.</p><h2>1. Mermelada de albaricoque sin azúcar añadido</h2><p>Cuece 1 kg de albaricoques troceados con el zumo de un limón a fuego medio durante 30 minutos. El propio azúcar natural de la fruta es suficiente para conseguir una textura perfecta.</p><h2>2. Tarta de albaricoque y almendra</h2><p>Una base de pasta brisa, crema de almendra y albaricoques cortados por la mitad. 40 minutos de horno a 180 °C y un postre de restaurante en tu mesa.</p><h2>3. Salsa agridulce para carnes</h2><p>Sofríe cebolla, añade albaricoques, un chorrito de vinagre de manzana y deja reducir. Perfecta con pechuga de pollo o lomo de cerdo.</p><h2>4. Ensalada con albaricoque y rúcula</h2><p>Rúcula fresca, albaricoques en láminas, queso de cabra y nueces. Aliña con aceite de oliva virgen extra y miel.</p><h2>5. Smoothie de albaricoque y yogur</h2><p>Bate 4 albaricoques maduros con un yogur natural, un chorrito de leche y hielo. Refrescante y nutritivo para el desayuno.</p>',
                'fecha_public' => '2026-03-22',
                'imagen'       => 'blog/albaricoque.jpeg',
                'tipo_post_id' => $recetas->id,
            ],
            [
                'titulo'       => 'Qué significa el sello CAAE y por qué importa',
                'noticia'      => '<p>La certificación ecológica no es un simple logotipo: implica años de trabajo, controles rigurosos y un compromiso real con el medio ambiente. Te explicamos qué es el CAAE y por qué es garantía de confianza.</p><h2>Qué es el CAAE</h2><p>El Comité Andaluz de Agricultura Ecológica (CAAE) es el organismo de certificación y control de la producción ecológica en Andalucía. Es reconocido por el Ministerio de Agricultura y la Unión Europea.</p><h2>Cómo se obtiene</h2><p>Para obtener la certificación, el productor debe someterse a un periodo de conversión de al menos 2 años durante el cual no puede usar pesticidas ni fertilizantes de síntesis. Durante este tiempo y cada año posterior, inspectores del CAAE realizan visitas y toman muestras.</p><blockquote>La certificación ecológica es la prueba de que alguien ha revisado lo que comes antes que tú.</blockquote><h2>Por qué importa al consumidor</h2><p>Al comprar un producto con sello CAAE sabes que ha pasado controles independientes, que el agricultor trabaja bajo normas estrictas y que lo que llevas a casa es realmente ecológico.</p>',
                'fecha_public' => '2026-03-10',
                'imagen'       => 'blog/sello.jpeg',
                'tipo_post_id' => $noticias->id,
            ],
            [
                'titulo'       => 'Hierbas aromáticas ecológicas: propiedades y usos en cocina',
                'noticia'      => '<p>Tomillo, romero, orégano… las hierbas aromáticas que crecen en nuestros campos tienen usos medicinales y culinarios sorprendentes. Aprende a sacarles el máximo partido en tu cocina diaria.</p><h2>Tomillo</h2><p>Antiséptico natural y expectorante. En cocina es imprescindible para marinadas, guisos y asados. Combina especialmente bien con carnes de caza y legumbres.</p><h2>Romero</h2><p>Estimulante y antioxidante. Su aroma intenso resiste cocciones largas, por lo que es ideal para asados al horno y aceites aromatizados. También va muy bien con patatas.</p><h2>Orégano</h2><p>Antiinflamatorio y digestivo. El clásico de la cocina mediterránea. Aporta un sabor cálido y ligeramente picante a pizzas, salsas de tomate y ensaladas de queso fresco.</p><ul><li>Usa siempre hierbas frescas cuando puedas: el sabor es incomparable.</li><li>Las hierbas secas son más concentradas: usa la mitad de la cantidad.</li><li>Añade las hierbas más delicadas (albahaca, perejil) al final de la cocción.</li></ul>',
                'fecha_public' => '2026-02-28',
                'imagen'       => 'blog/herbas.jpeg',
                'tipo_post_id' => $consejos->id,
            ],
        ];

        foreach ($posts as $datos) {
            PostBlog::updateOrCreate(
                ['titulo' => $datos['titulo']],
                $datos
            );
        }
    }
}
