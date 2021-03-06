PGDMP     %                    x         
   what2watch    12.2    12.2                0    0    ENCODING    ENCODING        SET client_encoding = 'UTF8';
                      false                       0    0 
   STDSTRINGS 
   STDSTRINGS     (   SET standard_conforming_strings = 'on';
                      false                       0    0 
   SEARCHPATH 
   SEARCHPATH     8   SELECT pg_catalog.set_config('search_path', '', false);
                      false                       1262    16471 
   what2watch    DATABASE     �   CREATE DATABASE what2watch WITH TEMPLATE = template0 ENCODING = 'UTF8' LC_COLLATE = 'English_United States.1252' LC_CTYPE = 'English_United States.1252';
    DROP DATABASE what2watch;
                postgres    false            �            1259    16485    movies    TABLE       CREATE TABLE public.movies (
    movie_id integer NOT NULL,
    title text,
    plot text,
    director text,
    year_release integer,
    ratingimdb double precision,
    postimglink text,
    coverimglink text,
    genres text[],
    duration text,
    ytlink text
);
    DROP TABLE public.movies;
       public         heap    postgres    false            �            1259    16483    movies_movie_id_seq    SEQUENCE     �   CREATE SEQUENCE public.movies_movie_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 *   DROP SEQUENCE public.movies_movie_id_seq;
       public          postgres    false    205                       0    0    movies_movie_id_seq    SEQUENCE OWNED BY     K   ALTER SEQUENCE public.movies_movie_id_seq OWNED BY public.movies.movie_id;
          public          postgres    false    204            �            1259    16474    users    TABLE     �   CREATE TABLE public.users (
    user_id integer NOT NULL,
    username character varying(60) NOT NULL,
    password_user text NOT NULL,
    email text NOT NULL,
    role_user character varying(30)
);
    DROP TABLE public.users;
       public         heap    postgres    false            �            1259    16472    users_user_id_seq    SEQUENCE     �   CREATE SEQUENCE public.users_user_id_seq
    AS integer
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;
 (   DROP SEQUENCE public.users_user_id_seq;
       public          postgres    false    203                       0    0    users_user_id_seq    SEQUENCE OWNED BY     G   ALTER SEQUENCE public.users_user_id_seq OWNED BY public.users.user_id;
          public          postgres    false    202            �
           2604    16488    movies movie_id    DEFAULT     r   ALTER TABLE ONLY public.movies ALTER COLUMN movie_id SET DEFAULT nextval('public.movies_movie_id_seq'::regclass);
 >   ALTER TABLE public.movies ALTER COLUMN movie_id DROP DEFAULT;
       public          postgres    false    205    204    205            �
           2604    16477    users user_id    DEFAULT     n   ALTER TABLE ONLY public.users ALTER COLUMN user_id SET DEFAULT nextval('public.users_user_id_seq'::regclass);
 <   ALTER TABLE public.users ALTER COLUMN user_id DROP DEFAULT;
       public          postgres    false    202    203    203                      0    16485    movies 
   TABLE DATA           �   COPY public.movies (movie_id, title, plot, director, year_release, ratingimdb, postimglink, coverimglink, genres, duration, ytlink) FROM stdin;
    public          postgres    false    205   X                 0    16474    users 
   TABLE DATA           S   COPY public.users (user_id, username, password_user, email, role_user) FROM stdin;
    public          postgres    false    203   ?                  0    0    movies_movie_id_seq    SEQUENCE SET     A   SELECT pg_catalog.setval('public.movies_movie_id_seq', 3, true);
          public          postgres    false    204                       0    0    users_user_id_seq    SEQUENCE SET     ?   SELECT pg_catalog.setval('public.users_user_id_seq', 1, true);
          public          postgres    false    202            �
           2606    16493    movies movies_pkey 
   CONSTRAINT     V   ALTER TABLE ONLY public.movies
    ADD CONSTRAINT movies_pkey PRIMARY KEY (movie_id);
 <   ALTER TABLE ONLY public.movies DROP CONSTRAINT movies_pkey;
       public            postgres    false    205            �
           2606    16482    users users_pkey 
   CONSTRAINT     S   ALTER TABLE ONLY public.users
    ADD CONSTRAINT users_pkey PRIMARY KEY (user_id);
 :   ALTER TABLE ONLY public.users DROP CONSTRAINT users_pkey;
       public            postgres    false    203               �  x�m�ۊ�0�����H,�ٰ��9K�M)%t{U({�F#���w�8��z!Ѐ�����.((!��T4Q`���ϔ@��s�h�e�-��2 �%d�3K;��)�3E��]�	"%��KY�"v���uU��AdL�ɣؕ��Q�X�x2s5Ε!o�f[�7�~I(����%�����!�mp&�P2������Vu�ޚ�~�s�F�i<;~�t��K���:��o�`�v����|:���a�)�{=jɑ/���39�=*���$@"k!�=�t�{�1����q�ǌ��ȑ�=|��Y��IS���������H�n:8Zl���wu �,�6Rks�.�	!�185ک��]Y���B&5��+n˻W��ɡ���r�9�i\�����Y\2
c�cUWu�N�4M%�0C��T�,������}ೣ�*�I��>�Wy����Ի�0>�S��ŏr�X��.�2         L   x�3�tL����4M3IIN6N2ML473M13L�062OIM��0JN���,�,*�K-q��/�M���K�υh����� 9�     