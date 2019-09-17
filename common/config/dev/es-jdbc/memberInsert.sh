#!/bin/sh
export JDBC_IMPORTER_HOME=/usr/local/elasticsearch-jdbc
export JAVA_HOME=/usr/local/jdk
export CLASSPATH=.:$JAVA_HOME:$JAVA_HOME/lib:$JAVA_HOME/jre/lib
export PATH=$JAVA_HOME/bin:$JAVA_HOME/jre/bin:$PATH
export JDBC_IMPORTER_HOME=/usr/local/elasticsearch-jdbc
bin=$JDBC_IMPORTER_HOME/bin
lib=$JDBC_IMPORTER_HOME/lib
cd /home/asl/dev/common/config/dev/es-jdbc/
        java \
        -cp "${lib}/*" \
        -Dlog4j.configurationFile=${bin}/log4j2.xml \
        org.xbib.tools.Runner \
        org.xbib.tools.JDBCImporter memberInsert.json