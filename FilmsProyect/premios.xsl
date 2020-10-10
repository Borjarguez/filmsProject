<?xml version="1.0"?>

<xsl:stylesheet version="1.0" 
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

    <xsl:output method="html" version="5.0" encoding="utf-8" indent="yes" />

    <xsl:template match="/">
        <xsl:text disable-output-escaping='yes'>&lt;!doctype html&gt;</xsl:text>
        <html lang="es">

            <head>
                <title>Premios de las películas</title>
                <meta name="author" content="Borja Rodriguez"/>
                <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
                <link rel="stylesheet" type="text/css" href="css/style.css" />
            </head>

            <body>
                <header>
                    <h1>Premios</h1>
                    <nav>
                        <a title="Página principal" accesskey="p" tabindex="1" href="todas.php">Pagina Principal</a>
                        <a title="Ayuda" accesskey="a" tabindex="2" href="Ayuda/Ayuda_premios.html">Ayuda</a>
                    </nav>
                </header>
                <h2>Información de los premios</h2>

                <xsl:apply-templates select="/films/film"/>

            </body>
        </html>
    </xsl:template>

    <xsl:template match="/films/film">
        <div class="tabla">
            <h3>
                <xsl:value-of select="@title"/>
            </h3>

            <table class="peliculas">
                <thead>
                    <tr>
                        <th>Premio</th>
                        <th>Quien lo recibe</th>
                        <th>Fecha</th>
                    </tr>
                </thead>
                <tbody>
                    <xsl:for-each select="awards/award">
                        <tr>
                            <td>
                                <xsl:value-of select="@name"/>
                            </td>
                            <td>
                                <xsl:if test="actor_name">
                                    <xsl:value-of select="actor_name"/>
                                </xsl:if>
                                <xsl:if test="not(actor_name)">
                            La pelicula
                                </xsl:if>
                            </td>
                            <td>
                                <xsl:value-of select="date"/>
                            </td>
                        </tr>
                    </xsl:for-each>
                </tbody>
            </table>
        </div>
    </xsl:template>

</xsl:stylesheet>